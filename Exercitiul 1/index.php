<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <style>
        .del{
            text-decoration: line-through;
            color: lightgray;
        }
    </style>
</head>
<body class="bg-info">
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-12 my-2 p-4 border bg-light" id="shopping-list">
                <div class="py-3">
                    <h2>{{ header.toLocaleUpperCase() }}</h2>
                    <button v-if="state === 'default'" class="btn btn-primary" @click="changeState('edit')">Add Item</button>
                    <button v-else class="btn btn-secondary" @click="changeState('default')">Cancel</button>
                    <p class="text-danger" v-if="error">Date invalide</p>
                </div>
                <div v-if="state === 'edit'" class="form-group d-flex flex-row" >
                    <textarea type="text" v-model="newItem" @keyup.enter="saveItem" placeholder="New item" class="form-control w-75"> </textarea>
                    <p class="w-25 text-center">{{ characterCount }} / 200</p>
                    <button class="btn btn-success" v-bind:disabled="newItem.length === 0" @click="saveItem">Save</button>
                </div>
                <ul class="list-group mt-3">
                    <li class="list-group-item d-flex flex-row" v-for="item in reversedItems" :class="{ del: item.purchased }" @click="togglePurchased(item)">
                        {{ item.label }}
                    </li>
                </ul>
                <p v-if="items.length === 0" class="font-weight-bold">Nice job! </p>
            </div>
        </div>
    </div>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/vue/dist/vue.min.js"></script>
    <script>
        var shoppingList = new Vue({
            el: '#shopping-list',
            data: {
                error: false,
                state: 'default',
                header : 'Lista de cumparaturi',
                newItem: '',
                items: [
                    {
                        label: 'Mere',
                        purchased: false,
                        highPriority: false,
                    },
                    {
                        label: 'Struguri',
                        purchased: true,
                        highPriority: false,
                    },
                    {
                        label: 'Ardei',
                        purchased: false,
                        highPriority: true,
                    }
                ]
            },
            computed: {
                characterCount(){
                    return this.newItem.length;
                },
                reversedItems(){
                    return this.items.slice(0).reverse();
                }
            },
            methods: {
                saveItem: function () {
                    if (this.newItem.length > 0){
                        this.error = false;
                        this.items.push({
                            label: this.newItem,
                            purchased: false
                        });
                    }else{
                        this.error = true;
                    }
                    this.newItem = "";
                },
                changeState: function (newState) {
                    this.state = newState;
                    this.newItem = '';
                },
                togglePurchased: function (item) {
                    item.purchased = !item.purchased;
                }
            }
        });
    </script>
</body>
</html>