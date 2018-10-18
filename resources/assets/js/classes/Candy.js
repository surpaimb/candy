'use strict';

class Candy {

    attribute(data, attr) {
        return _.get(data, ['attribute_data', attr, channel, language]);
    }

    route(data) {
        const route = this.altFind(data.routes.data, route => {
            return route.locale == language;
        });
        return route.slug;
    }

    reward(data) {
        switch(data.type) {
            case 'percentage':
                return '- '+ data.value +'%';
            case 'free_shipping':
                return 'Free Shipping';
            case 'fixed_amount':
                return currency.symbol + data.value;
            default:
                return data.value;
        }
    }

    youtubeEmbed(url) {
        return url.replace("watch?v=", "embed/");
    }

    thumbnail(data) {
        if (_.has(data,['data','thumbnail'])) {
            return _.get(data,['data','thumbnail']);
        }
        return '/images/no-image.png';
    }

    nonreactive(data) {
        return JSON.parse(JSON.stringify(data));
    }

    mapVariant(variants, selected) {

        var response = {};
        var $this = this;

        // Go through each variant and check if combination matches the current combination
        $.each(variants.data, function(index, variant) {
            var i = 1;

            var optionCheck = $.each(variant.options, function(option, value) {
                if (selected[option][language] !== value[language]) {
                    return false;
                } else if (selected[option][language] == value[language] && _.size(selected) == i) {
                    response = variant;
                }
                i++;
            });

            if (!optionCheck) {
                return false;
            }
        });

        // Return response
        return response;
    }

    updateQueryStringParam(param, value) {
        var baseUrl = [location.protocol, '//', location.host, location.pathname].join('');
        var urlQueryString = document.location.search;
        var newParam = param + '=' + value;
        var params = '?' + newParam;

        // If the "search" string exists, then build params from it
        if (urlQueryString) {
          var keyRegex = new RegExp('([\?&])' + param + '[^&]*');
          // If param exists already, update it
          if (urlQueryString.match(keyRegex) !== null) {
            params = urlQueryString.replace(keyRegex, "$1" + newParam);
          } else { // Otherwise, add it to end of query string
            params = urlQueryString + '&' + newParam;
          }
        }
        window.history.replaceState({}, "", baseUrl + params);
    }

    altFind(arr, callback) {
        for (var i = 0; i < arr.length; i++) {
            var match = callback(arr[i]);
            if (match) {
                return arr[i];
                break;
            }
        }
    }

}

module.exports = Candy;