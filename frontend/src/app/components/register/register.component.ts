import { Component, OnInit } from '@angular/core';
import {Title} from "@angular/platform-browser";
import {UserService} from "../../services/user.service";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {User} from "../../models/user.model";
import {ToastrService} from "ngx-toastr";
import {Router} from "@angular/router";

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.less']
})
export class RegisterComponent implements OnInit {

  form: FormGroup

  constructor(
    private readonly titleService: Title,
    private readonly userService: UserService,
    private readonly formBuilder: FormBuilder,
    private readonly toastService: ToastrService,
    private readonly router: Router
  ) {
    this.titleService.setTitle('Turbo - Das Autoquiz | Registrieren');
  }

  ngOnInit(): void {
    this.createForm();
  }

  createForm(): void {
    this.form = this.formBuilder.group({
      username: ['', [Validators.required]],
      email: ['', [Validators.required]],
      password: ['', [Validators.required]],
      repeatPassword: ['', Validators.required]
    })
  }

  register(): void {
    if(this.form.get('password').value !== this.form.get('repeatPassword').value) {
      this.toastService.error('Die Passwörter stimmen nicht überein');
      return;
    }

    this.userService.registerUser(
      this.form.get('username').value,
      this.form.get('email').value,
      this.form.get('password').value
    ).subscribe({
      next: () => {
        this.router.navigate(['/']);
        this.toastService.success('Erfolgreich registriert!');
      },
      error: (err) => {
          if(err.error?.message) {
            this.toastService.error(err.error.message.replace('\n', '<br>'), '', { enableHtml: true });
          }
        }
    });
  }
}
