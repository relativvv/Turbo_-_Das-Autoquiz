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

}
