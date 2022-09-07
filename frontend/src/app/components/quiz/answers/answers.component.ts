import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'app-answers',
  templateUrl: './answers.component.html',
  styleUrls: ['./answers.component.less']
})
export class AnswersComponent implements OnInit {

  @Input() answers: string[];
  @Input() lockedAnswer: string;

  constructor() { }

  ngOnInit(): void {
  }

}
