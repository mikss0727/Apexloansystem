//   form validation 
function compute(amount,rate) {
    const loan_amount = parseFloat(amount);
    const loan_rate = parseFloat(rate);
    const standard_months = 3;

    const total_rate = loan_amount * loan_rate;
    const total_profit = total_rate * standard_months;
    const total_client_loan = loan_amount + total_profit;


    return total_client_loan;
}
