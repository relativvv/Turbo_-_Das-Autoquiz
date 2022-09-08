import {Component, Input, OnInit} from '@angular/core';

export interface TableElement {
  name: string;
  highestStreak: number;
  overAllCorrect: number;
  playedGames: number;
}

const ELEMENT_DATA: TableElement[] = [
  {name: 'xxx', highestStreak: 0, overAllCorrect: 0, playedGames: 0},
];


@Component({
  selector: 'app-statics-table',
  templateUrl: './statics-table.component.html',
  styleUrls: ['./statics-table.component.less']
})
export class StaticsTableComponent implements OnInit {

  @Input() heading: string;

  displayedColumns: string[] = ['name', 'highestStreak', 'overAllCorrect', 'playedGames'];
  dataSource = ELEMENT_DATA;

  constructor() { }

  ngOnInit(): void {
  }

}
