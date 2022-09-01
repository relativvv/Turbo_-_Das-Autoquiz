import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from "@angular/router";
import {Title} from "@angular/platform-browser";

@Component({
  selector: 'app-specify-mode',
  templateUrl: './specify-mode.component.html',
  styleUrls: ['./specify-mode.component.less']
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
