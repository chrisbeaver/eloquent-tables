<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">        
    </head>
    <body>
        <table class="eloquent-table" data-target="/products">
            <thead>
                <th><h1>ID</h1></th>
                <th>Company</th>
                <th>Name</th>
                <th>Price</th>
            </thead>
            <tbody>
            </tbody>
        </table>        
    </body>
    <script>
        (function() {
            let tables = document.getElementsByClassName("eloquent-table");
            let headers = [].slice
                            .call(tables[0].tHead.querySelectorAll("th"))
                            .map(function(header) {
                                return header.innerHTML;
                            });
            let rows;
            let paginator;
            
            function buildTable(payload)
            {
                console.log(payload);
                payload.data.forEach(function(data) {
                    
                    var row = tables[0].getElementsByTagName('tbody')[0].insertRow(-1);
                    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);

                    // Add some text to the new cells:
                    cell1.innerHTML = data.id;
                    cell2.innerHTML = data.company.name;
                    cell3.innerHTML = data.name;
                    cell4.innerHTML = data.price;
                });
                console.log(paginator);
                paginator.innerHTML = payload.count;

            }

            function reqListener()
            {
                rows = JSON.parse(this.responseText);
                buildTable(rows);
            }

            function initializeTable()
            {
                let newItem = document.createElement("div");       // Create a <li> node
                // var textnode = document.createTextNode("Water");  // Create a text node
                // newItem.appendChild(textnode);                    // Append the text to <li>

                let table = tables[0]; 
                document.body.insertBefore(newItem, table);
                newItem.appendChild(table);

                paginator = document.createElement("div");
                paginator.className = "paginator";
                newItem.appendChild(paginator);
            }

            function getData()
            {
                let  r = new XMLHttpRequest();
                
                r.open("POST", tables[0].getAttribute("data-target"), true);
                r.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
                r.setRequestHeader("take", "10");
                r.setRequestHeader("skip", "5");
                r.setRequestHeader("search", "Wiza");
                r.addEventListener("load", reqListener);
                r.onreadystatechange = function () {
                    if (r.readyState != 4 || r.status != 200) return; 
                    // console.log(r.responseText);
                };
                r.send("take=1");
            }
            initializeTable();
            getData();
            
        })();
    </script>
</html>