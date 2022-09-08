import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'app-lives',
  templateUrl: './lives.component.html',
  styleUrls: ['./lives.component.less']
})
export class LivesComponent implements OnInit {

  @Input() lives: number;

  constructor() { }

  ngOnInit(): void {
  }

}
