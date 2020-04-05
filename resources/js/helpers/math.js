export const calculateRatio = (num_1, num_2) => {
    for (let num = num_2; num > 1; num--) {
        if ((num_1 % num) === 0 && (num_2 % num) === 0) {
            num_1=num_1 / num;
            num_2=num_2 / num;
        }

    }

    return num_1 + ":" + num_2;
}
