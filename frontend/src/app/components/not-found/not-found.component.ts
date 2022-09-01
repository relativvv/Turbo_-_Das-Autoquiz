import { Component, OnInit } from '@angular/core';
import {Title} from "@angular/platform-browser";

@Component({
  selector: 'app-not-found',
  templateUrl: './not-found.component.html',
  styleUrls: ['./not-found.component.less']
})
export class NotFoundComponent implements OnInit {

  constructor(
    private readonly titleService: Title
  ) {
    this.titleService.setTitle('Turbo - Das Autoquiz | 404');
  }

  ngOnInit(): void {
  }

}
