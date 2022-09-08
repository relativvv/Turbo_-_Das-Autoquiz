import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {MatDialog} from "@angular/material/dialog";
import {ChangePasswordModalComponent} from "./change-password-modal/change-password-modal.component";
import {Title} from "@angular/platform-browser";
import {ActivatedRoute, Router} from "@angular/router";
import {User} from "../../models/user.model";
import {UserService} from "../../services/user.service";
import {ToastrService} from "ngx-toastr";
import {switchMap} from "rxjs";

@Component({
  selector: 'app-user-details',
  templateUrl: './user-details.component.html',
  styleUrls: ['./user-details.component.less']
})
export class UserDetailsComponent implements OnInit {

  userForm: FormGroup;
  user: User;

  selectedFile: any;
  selectedFileBase64: string;


  constructor(
    private readonly formBuilder: FormBuilder,
    private readonly dialogService: MatDialog,
    private readonly titleService: Title,
    private readonly route: ActivatedRoute,
    private readonly userService: UserService,
    private readonly router: Router,
    private readonly toastService: ToastrService
  ) {
  }

  ngOnInit(): void {
    console.log(document.cookie);
    if(!this.userService.isLoggedIn()) {
      this.router.navigate(['/']);
      this.toastService.error('Du bist nicht eingeloggt!');
    }

    this.userService.currentUser
      .pipe(
        switchMap((user: User) => {
          this.user = user;
          return this.route.params
        })
      )
      .subscribe((params) => {
        if(params['userName'] === this.user.username) {
          this.titleService.setTitle('Turbo - Das Autoquiz | ' + params['userName']);
          this.createForm();
        } else {
          this.toastService.error('Das sind nicht deine Nutzerdetails!');
          this.router.navigate(['/']);
        }

      })

  }

  createForm(): void {
    this.userForm = this.formBuilder.group({
      username: [{value: this.user.username, disabled: true}],
      email: [this.user.email, [Validators.required]],
      password: [{value: 'ichbineinbeispielpasswort', disabled: true}]
    })
  }

  openChangePassword(): void {
    this.dialogService.open(ChangePasswordModalComponent);
  }

  updateEmail(): void {
    const payload = {
      email: this.userForm.get('email')
    };

    this.userService.updateUser(payload);
  }

  updateAvatar(): void {
    const payload = {
      avatar: this.selectedFileBase64
    }

    this.userService.updateUser(payload).subscribe({
      next: () => {
        this.toastService.success('Avatar erfolgreich geändert!')
      },
      error: () => {
        this.toastService.error('Avatar konnte nicht geändert werden');
      }
    });
  }

  picked(event: any) {
    const file: File = event.target.files[0];
    this.selectedFile = file;
    this.handleInputChange(file);
  }

  handleInputChange(files): void {
    const file = files;
    const pattern = /image-*/;
    const reader = new FileReader();

    if (!file.type.match(pattern)) {
      this.toastService.error('The file has an invalid format');
      this.selectedFile = null;
      (document.getElementById('picture') as HTMLInputElement).value = null;
      return;
    }
    reader.onloadend = this._handleReaderLoaded.bind(this);
    reader.readAsDataURL(file);
  }

  _handleReaderLoaded(e): void {
    const reader = e.target;
    this.selectedFileBase64 = 'data:image/png;base64,' + reader.result.substr(reader.result.indexOf(',') + 1);
  }

  updatePassword(): void {
    const payload = {
      oldPassword: null,
      new_password: null
    }
    this.userService.updateUser(payload);
  }

}
