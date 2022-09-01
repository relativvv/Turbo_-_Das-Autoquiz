import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'app-mode-card',
  templateUrl: './mode-card.component.html',
  styleUrls: ['./mode-card.component.less']
})
export class ModeCardComponent implements OnInit {

  @Input() text: string;
  @Input() imageSource: string;

  constructor() { }

  ngOnInit(): void {
  }

}
