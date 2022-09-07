import {Component, Inject, OnInit} from '@angular/core';
import {MAT_DIALOG_DATA} from "@angular/material/dialog";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'app-change-password-modal',
  templateUrl: './change-password-modal.component.html',
  styleUrls: ['./change-password-modal.component.less']
})
export class ChangePasswordModalComponent implements OnInit {

  form: FormGroup;

  constructor(
    @Inject(MAT_DIALOG_DATA) public data: any,
    private readonly formBuilder: FormBuilder
  ) {}

  ngOnInit(): void {
    this.createForm()
  }

  createForm(): void {
    this.form = this.formBuilder.group({
      oldPassword: ['', [Validators.required]],
      password: ['', [Validators.required]],
      passwordConfirm: ['', [Validators.required]]
    });
  }

}
