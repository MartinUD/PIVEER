import { Component } from '@angular/core';
import { CommonModule,NgFor } from '@angular/common';

@Component({
  selector: 'app-workout-card',
  standalone: true,
  imports: [CommonModule, NgFor],
  templateUrl: './workout-card.component.html',
  styleUrl: './workout-card.component.css'
})
export class WorkoutCardComponent {
  public workouts:Number[] = [1, 2, 3, 4];

  ngOnInit(): void {
    let workouts = [1, 2, 3, 4]
  }
  constructor() { 
  }
}
