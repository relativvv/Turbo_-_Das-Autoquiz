import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'app-question',
  templateUrl: './question.component.html',
  styleUrls: ['./question.component.less']
})
export class QuestionComponent implements OnInit {

  @Input() question: string;
  @Input() timer: string;

  constructor() { }

  ngOnInit(): void {
  }

}
