$( document ).ready(function() {
	"use strict";


	Morris.Donut( {
		element: 'morris-donut-chart',
		data: [ {
			label: "Download Sales",
			value: 12,

        }, {
			label: "In-Store Sales",
			value: 30
        }, {
			label: "Mail-Order Sales",
			value: 20
        } ],
		resize: true,
		colors: [ '#4680ff', '#26DAD2', '#fc6180' ]
	} );





});