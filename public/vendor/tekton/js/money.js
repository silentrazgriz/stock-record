let tektonMoneys = Sizzle('.tekton-money');
tektonMoneys.forEach((money) => {
    cleaves.push(new Cleave(money, {
        numeral: true,
        numeralDecimalMark: ',',
        delimiter: '.'
    }));
});