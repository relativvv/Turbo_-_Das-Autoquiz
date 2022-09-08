import { Component, OnInit } from '@angular/core';
import {Title} from "@angular/platform-browser";
import {UserService} from "../../services/user.service";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Router} from "@angular/router";
import {ToastrService} from "ngx-toastr";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.less']
})
export class LoginComponent implements OnInit {

  form: FormGroup;

  constructor(
    private readonly titleService: Title,
    private readonly userService: UserService,
    private readonly formBuilder: FormBuilder,
    private readonly router: Router,
    private readonly toastService: ToastrService
  ) {
    this.titleService.setTitle('Turbo - Das Autoquiz | Login');
  }

  ngOnInit(): void {
    this.createForm();
  }

  login(): void {
    if(!this.form.invalid) {
      this.userService.loginUser(
        this.form.get('identity').value,
        this.form.get('password').value
      ).subscribe({
        next: () => {
          this.toastService.success('Erfolgreich eingeloggt!')
          this.router.navigate(['/']);
        }, error: () => {
          this.toastService.error('Einloggen fehlgeschlagen!')
        }
      });
    }
  }

  private createForm(): void {
    this.form = this.formBuilder.group({
      identity: ['', [Validators.required]],
      password: ['', [Validators.required]]
    });
  }

}
