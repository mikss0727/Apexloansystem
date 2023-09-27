function generateLoanSchedule(loanTerm, LoanAmount, DisbursementDate, TermTypeDaysNo) {
  const schedule = [];
  const DisbDate = new Date(DisbursementDate); // convert date
  const oneWeek = TermTypeDaysNo * 24 * 60 * 60 * 1000; // TermTypeDaysNo days in milliseconds
  const payment = parseFloat(LoanAmount) / loanTerm;
  let balance = parseFloat(LoanAmount);

  // Add one week from the disbursement date
  const startDate = new Date(DisbDate.getTime() + oneWeek);

  for (let i = 0; i < loanTerm; i++) {
    balance -= payment;
    const repaymentDate = new Date(startDate.getTime() + i * oneWeek);
    schedule.push({
      installment: i + 1,
      dueDate: repaymentDate.toDateString(),
      balance: balance.toFixed(2),
      payment: payment.toFixed(2)
    });
    
  }

  return schedule;
}
