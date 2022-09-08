import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './header/header.component';
import { ProfileComponent } from './profile/profile.component';
import {MatIconModule} from "@angular/material/icon";
import {MatButtonModule} from "@angular/material/button";
import {RouterModule} from "@angular/router";
import {MatButtonToggleModule} from "@angular/material/button-toggle";
import {MatMenuModule} from "@angular/material/menu";



@NgModule({
  declarations: [
    HeaderComponent,
    ProfileComponent
  ],
    exports: [
        HeaderComponent,
        ProfileComponent
    ],
    imports: [
        CommonModule,
        MatIconModule,
        MatButtonModule,
        RouterModule,
        MatButtonToggleModule,
        MatMenuModule
    ]
})
export class SharedModule { }
