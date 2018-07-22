paypal.Button.render({
  env: 'sandbox',
  commit: true,
  payment: function (data, actions) {
    return paypal.request.post(dirname + 'payment/buy', {
      id: idOffer
    }).then(function(data) {
      return data.id;
    });
  },
  onAuthorize: function (data, actions) {
    return paypal.request.post(dirname + 'payment/execute', {
      paymentID: data.paymentID,
      payerID: data.payerID,
      id: idOffer
    }).then(function(data) {
      alert("ok");
    }).catch(function(err) {
      alert('error');
    });
  }
}, '#paypal-button');