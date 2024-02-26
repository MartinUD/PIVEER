// Set the target date for the countdown (Year, Month (0-11), Day, Hour, Minute, Second)
const targetDate = new Date('2024-12-31T00:00:00').getTime();

// Update the countdown every second
const countdown = setInterval(() => {
    // Get the current date and time
    const currentDate = new Date().getTime();
    
    // Calculate the remaining time
    const remainingTime = targetDate - currentDate;
    
    // Calculate days, hours, minutes, and seconds
    const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
    const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
    
    // Display the countdown
    document.getElementById('countdown').innerHTML = `
        <p>Countdown to ${targetDate.toLocaleDateString()}:</p>
        <p>${days} days ${hours} hours ${minutes} minutes ${seconds} seconds</p>
    `;
    
    // If the countdown is over, stop the timer
    if (remainingTime < 0) {
        clearInterval(countdown);
        document.getElementById('countdown').innerHTML = 'Countdown expired!';
    }
}, 1000); // Update every second
