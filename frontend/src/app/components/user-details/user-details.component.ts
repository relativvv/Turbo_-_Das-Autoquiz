import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup} from "@angular/forms";
import {MatDialog} from "@angular/material/dialog";
import {ChangePasswordModalComponent} from "./change-password-modal/change-password-modal.component";
import {Title} from "@angular/platform-browser";
import {ActivatedRoute, Router} from "@angular/router";

@Component({
  selector: 'app-user-details',
  templateUrl: './user-details.component.html',
  styleUrls: ['./user-details.component.less']
})
export class UserDetailsComponent implements OnInit {

  userForm: FormGroup;

  constructor(
    private readonly formBuilder: FormBuilder,
    private readonly dialogService: MatDialog,
    private readonly titleService: Title,
    private readonly route: ActivatedRoute
  ) {
  }

  ngOnInit(): void {
    this.createForm();
    this.route.params.subscribe(params => {
      this.titleService.setTitle('Turbo - Das Autoquiz | ' + params['userName']);
    })
  }

  createForm(): void {
    this.userForm = this.formBuilder.group({
      username: [''],
      email: [''],
      password: [{value: 'ichbineinbeispielpasswort', disabled: true}]
    })
  }

  openChangePassword(): void {
    this.dialogService.open(ChangePasswordModalComponent, {
      data: {
        test: null
      }
    })
  }

}
