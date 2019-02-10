var ctx = document.getElementById("transactions-chart").getContext('2d');

labels = transactions.map(transaction => transaction.name);

data = transactions.map(transaction => transaction.transactions_count);

