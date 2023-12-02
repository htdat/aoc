#!/usr/bin/env node

const fs = require('fs');
const data = fs.readFileSync(  __dirname + '/day02.txt', 'utf8');
const lines = data.split('\n').filter(line => line.length > 0);

// Part 1
let invalidResults = [];
for (const line of lines) {
    const gameId = parseInt(line.match(/Game\s(\d+)/)[1]);
    const gameData = line
        .split(':')[1].trim()
        .split(';')
        .map(item => item.trim() )
        .map(item => item.split(',').map(item => item.trim()) )
        .map(item => {
            let obj = {};
            item.forEach( numColor => {
                const [num, color] = numColor.split(' ');
                obj[color] = parseInt(num);
            });
            return obj
        })

    for (const obj of gameData) {
        const red = obj?.red ?? 0;
        const green = obj?.green ?? 0;
        const blue = obj?.blue ?? 0;
        if ( red > 12 || green > 13 || blue > 14 ) {
            invalidResults.push( gameId )
            break
        }
    }    
}

const totalInvalid = invalidResults.reduce((acc, cur) => acc + cur, 0) 
const totalValid = ( lines.length * (lines.length + 1) / 2 ) - totalInvalid;
console.log( 'Part 1: ' + totalValid); // Part 1: 2348