import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './header/header.component';
import { ProfileComponent } from './profile/profile.component';
import {MatIconModule} from "@angular/material/icon";
import {MatButtonModule} from "@angular/material/button";
import {RouterModule} from "@angular/router";



@NgModule({
  declarations: [
    HeaderComponent,
    ProfileComponent
  ],
  exports: [
    HeaderComponent
  ],
  imports: [
    CommonModule,
    MatIconModule,
    MatButtonModule,
    RouterModule
  ]
})
export class SharedModule { }
