$('.tekton-money').each((index, money) => {
    cleaves.push(new Cleave(money, {
        numeral: true,
        numeralDecimalMark: ',',
        delimiter: '.'
    }));
});