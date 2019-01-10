$('.filter-button').on('click', function () {
    var self = $(this),
        identity = self.data('identity'),
        allBikes = $('.bike-info'),
        newBikes = $('.new'),
        bikesForSale = $('.for-sale');

    $('.filter-button').removeClass('filter-selected');
    self.addClass('filter-selected');

    switch (identity) {
        case 'all':
            allBikes.show();
            break;
        case 'new':
            allBikes.hide();
            newBikes.show();
            break;
        case 'for-sale':
            allBikes.hide();
            newBikes.show();
            bikesForSale.show();
            break;
        default:
            allBikes.show();
            break
    }
});