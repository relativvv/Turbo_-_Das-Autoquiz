import {Component, Input, OnInit} from '@angular/core';

type Mode = 'difficulty' | 'category';

@Component({
  selector: 'app-mode-select',
  templateUrl: './mode-select.component.html',
  styleUrls: ['./mode-select.component.less']
})
export class ModeSelectComponent implements OnInit {

  @Input() type: Mode;
  @Input() text: string;

  constructor() { }

  ngOnInit(): void {
  }

}
