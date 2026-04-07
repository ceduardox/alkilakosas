jQuery(function ($) {
  'use strict';
  let getHeading = $('body').find('.wp-heading-inline');
  const baseUrl = 'https://rnb-doc.vercel.app/';
  const linkList = [
    'Deposit',
    'Resources',
    'Person',
    'Features',
    'Quote Request',
    'Inventories',
    'Add New Inventory',
    'Pickup Location',
    'Dropoff Location',
    'Attributes',
  ];
  let currentValue = getHeading.text();
  if (linkList.includes(currentValue.trim())) {
    let docLink = baseUrl + currentValue.toLowerCase();
    if (currentValue.trim() === 'Quote Request') {
      docLink = baseUrl + 'request-for-quote';
    }
    if (
      currentValue.trim() === 'Inventories' ||
      currentValue.trim() === 'Add New Inventory'
    ) {
      docLink = baseUrl + 'inventory-with-product';
    }
    if (currentValue.trim() === 'Resources') {
      docLink = baseUrl + 'Resources';
    }
    if (
      currentValue.trim() === 'Pickup Location' ||
      currentValue.trim() === 'Dropoff Location'
    ) {
      docLink = baseUrl + 'locations';
    }
    if (currentValue.trim() === 'Attributes') {
      docLink = baseUrl + 'attributes-and-features';
    }
    let linkHtml = `<a href = "${docLink}" title="rnb doc" target="_blank" style="text-decoration: none; font-size: 15px; margin-left: 8px;">View Doc</a>`;
    getHeading.append(linkHtml);
  }
});
