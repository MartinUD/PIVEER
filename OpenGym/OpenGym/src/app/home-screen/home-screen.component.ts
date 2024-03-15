import { Component, OnInit} from '@angular/core';
import { CommonModule } from '@angular/common';
import { WorkoutCardComponent } from './workout-card/workout-card.component';

@Component({
  selector: 'app-home-screen',
  standalone: true,
  imports: [CommonModule, WorkoutCardComponent],
  templateUrl: './home-screen.component.html',
  styleUrl: './home-screen.component.css'
})
export class HomeScreenComponent implements OnInit{
  workouts = [1, 2, 3, 4];

   constructor() { }
   
   ngOnInit(): void {
   }

}
