    var map, 
        searchManager;

    function GetMap() {
        var zoom=17;
        var hasCoordinates = false;

        if(latitude && longitude){
            hasCoordinates = true;
        }
        else{
            Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
                var searchManager = new Microsoft.Maps.Search.SearchManager(map);
                var requestOptions = {
                    bounds: map.getBounds(),
                    where: 'България,'+city+','+address,
                    callback: function (answer, userData) {
                        map.setView({ bounds: answer.results[0].bestView });
                        map.entities.push(new Microsoft.Maps.Pushpin(answer.results[0].location));
                    }
                };
                searchManager.geocode(requestOptions);
            });

            if(!hasCoordinates){
            latitude = 43.208975;
            longitude = 23.552773;
            zoom = 12;
            }
        }


        var map = new Microsoft.Maps.Map('#myMap', {
            credentials: auth,
            center: new Microsoft.Maps.Location(latitude,  longitude),
            zoom: zoom,
        });

        var center = map.getCenter();

        if(hasCoordinates){
        //Create custom Pushpin
        var pin = new Microsoft.Maps.Pushpin(center, {

        });

        //Add the pushpin to the map
        map.entities.push(pin);
        }
    }

   



    
        

