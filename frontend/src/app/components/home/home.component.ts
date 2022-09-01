import { Component, OnInit } from '@angular/core';
import {Title} from "@angular/platform-browser";
import {animate, style, transition, trigger} from "@angular/animations";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.less'],
  animations: [
    trigger('fade', [
      transition(':enter', [
        style({ position: 'relative', top: 25, opacity: 0 }),
        animate('1000ms', style({ opacity: 1, top: 0 }))
      ]),
      transition(':leave', [
        style({ top: 0, opacity: 1 }),
        animate('1000ms', style({ opacity: 0, top: 100 }))
      ]),
    ])
  ],
})
export class HomeComponent implements OnInit {

  constructor(
    private readonly titleService: Title
  ) {
    this.titleService.setTitle('Turbo - Das Autoquiz | Home')
  }

  ngOnInit(): void {
  }

}
