import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from "@angular/router";
import {Title} from "@angular/platform-browser";
import {animate, style, transition, trigger} from "@angular/animations";

@Component({
  selector: 'app-specify-mode',
  templateUrl: './specify-mode.component.html',
  styleUrls: ['./specify-mode.component.less'],
  animations: [
    trigger('fade', [
      transition(':enter', [
        style({ position: 'relative', top: 35, opacity: 0 }),
        animate('1000ms', style({ opacity: 1, top: 0 }))
      ]),
      transition(':leave', [
        style({ top: 0, opacity: 1 }),
        animate('1000ms', style({ opacity: 0, top: 100 }))
      ]),
    ])
  ],
})
export class SpecifyModeComponent implements OnInit {

  mode: 'difficulty' | 'category';

  constructor(
    private readonly route: ActivatedRoute,
    private readonly titleService: Title
  ) {
    this.titleService.setTitle('Turbo - Das Autoquiz | Modus auswählen');
  }

  ngOnInit(): void {
    this.getMode();
  }

  private getMode(): void {
    this.route.params.subscribe(params => {
      this.mode = params['selectedMode'];
    })
  }

}
