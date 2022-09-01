import { Component, OnInit } from '@angular/core';
import {Title} from "@angular/platform-browser";

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.less']
})
export class RegisterComponent implements OnInit {

  constructor(
    private readonly titleService: Title
  ) {
    this.titleService.setTitle('Turbo - Das Autoquiz | Registrieren');
  }

  ngOnInit(): void {
  }

}
