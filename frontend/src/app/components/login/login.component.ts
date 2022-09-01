import { Component, OnInit } from '@angular/core';
import {Title} from "@angular/platform-browser";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.less']
})
export class LoginComponent implements OnInit {

  constructor(
    private readonly titleService: Title
  ) {
    this.titleService.setTitle('Turbo - Das Autoquiz | Login');
  }

  ngOnInit(): void {
  }

}
