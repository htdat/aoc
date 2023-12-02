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
