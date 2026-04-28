$(document).ready(function() {
    $('.approve-ajax').click(function() {
        var quoteId = $(this).data('id');
        var button = $(this);

        var price = prompt("Enter the calculated shipping cost (Rs):");

        if (price !== null && price !== "") {
            
            if(confirm("Send approval email with price Rs." + price + " and generate shipment link?")) {
                
                button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
                
                $.ajax({
                    url: 'approve_quote.php',
                    type: 'GET',
                    data: { 
                        id: quoteId, 
                        amount: price 
                    },
                    success: function(response) {
                        button.removeClass('btn-approve').addClass('btn-success').html('<i class="fa fa-check"></i> Approved');
                        alert("Success: Notification with price Rs." + price + " sent to customer!");
                    },
                    error: function() {
                        alert("Error: Something went wrong.");
                        button.prop('disabled', false).html('<i class="fa fa-paper-plane mr-1"></i> Approve');
                    }
                });
            }
        } else if (price === "") {
            alert("Please enter a price to approve the quote.");
        }
    });
});