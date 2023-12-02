#!/usr/bin/env node

const fs = require('fs');
const data = fs.readFileSync(  __dirname + '/day01.txt', 'utf8');
const lines = data.split('\n').filter(line => line.length > 0);

// Part 1
function getCals(lines) {
    const cals = lines.map(line => {
        const digits = line.match(/\d{1}/g);
        return digits[0] + digits[digits.length - 1];
    });

    return cals;
}

function getArraySum( an_array ) {
    return an_array.reduce((acc, cur) => acc + parseInt(cur), 0);
}

const sum = getArraySum(getCals(lines));
console.log( 'Part 1: ' + sum); // 56108

// Part 2
const digitMap = {
    "one": 1,
    "two": 2,
    "three": 3,
    "four": 4,
    "five": 5,
    "six": 6,
    "seven": 7,
    "eight": 8,
    "nine": 9
}

const linesPart2 = lines.map(line => {
    let firstIndex = {}; 
    let lastIndex = {};
    for (const [letter, digit] of Object.entries(digitMap)) {
        const first = line.indexOf(letter);
        if ( -1 !== first ) {
            firstIndex[letter] = first;
        }

        const last = line.lastIndexOf(letter);
        if ( -1 !== last ) {
            lastIndex[letter] = last;
        }
    }

    const first = Math.min(...Object.values(firstIndex));
    const firstLetter = Object.keys(firstIndex).find(key => firstIndex[key] === first);

    const last = Math.max(...Object.values(lastIndex));
    const lastLetter = Object.keys(lastIndex).find(key => lastIndex[key] === last);

    line = line.replace(firstLetter, digitMap[firstLetter] + '' + firstLetter);

    line = line.slice(0, last+1) + digitMap[lastLetter] + line.slice(last+1);
    return line;
});

const sumPart2 = getArraySum(getCals(linesPart2));
console.log( 'Part 2: ' + sumPart2); // 55652