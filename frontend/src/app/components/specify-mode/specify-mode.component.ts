import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from "@angular/router";

@Component({
  selector: 'app-specify-mode',
  templateUrl: './specify-mode.component.html',
  styleUrls: ['./specify-mode.component.less']
})
export class SpecifyModeComponent implements OnInit {

  mode: 'difficulty' | 'category';

  constructor(
    private route: ActivatedRoute
  ) { }

  ngOnInit(): void {
    this.getMode();
  }

  private getMode(): void {
    this.route.params.subscribe(params => {
      this.mode = params['selectedMode'];
    })
  }

}
