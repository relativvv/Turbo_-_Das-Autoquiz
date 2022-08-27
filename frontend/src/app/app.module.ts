import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HomeComponent } from './components/home/home.component';
import {SharedModule} from "./shared/shared.module";
import { ModeSelectComponent } from './components/home/mode-select/mode-select.component';
import { StaticsTableComponent } from './components/home/statics-table/statics-table.component';
import {MatTableModule} from "@angular/material/table";
import {NgParticlesModule} from "ng-particles";
import {NgsRevealModule} from "ngx-scrollreveal";

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    ModeSelectComponent,
    StaticsTableComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    SharedModule,
    MatTableModule,
    NgParticlesModule,
    NgsRevealModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
