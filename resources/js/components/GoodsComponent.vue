<template>
    <div>
        <div v-if="!loading">
            <img class="rounder mx-auto d-block" :src="image" alt="loader" width="25%">
        </div>

        <div v-else>
            <table class="table" v-if="goodsArr">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Goods</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">District</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(good, index) in goodsArr">
                        <td>{{index+1}}</td>
                        <td>{{good.good}}</td>
                        <td>{{good.quantity}}</td>
                        <td>{{good.district}}</td>
                        <td><button @click="updateModal(index)" class="btn btn-edit">Update Record</button></td>
                        <td><button @click="deleteGoods(index)" class="btn btn-delete">Remove Record</button></td>
                    </tr>
                </tbody>
            </table>
            <button @click="createModal" class="btn btn-create btn-block">Record New Goods</button>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="create-modal-label">Relief Good Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" v-if="errors.length > 0">  
                            <ul>
                                <li v-for="error in errors">{{error}}</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="name">Good</label>
                            <input v-model="goods.good" type="text" id="good" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Quantity</label>
                            <input v-model="goods.quantity" type="text" id="quantity" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">District</label>
                            <input v-model="goods.district" type="text" id="district" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button @click="createGoods" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Create Modal -->
        <!-- Update Modal -->
        <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="update-modal-label">Edit Data Entry</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" v-if="errors.length > 0">  
                            <ul>
                                <li v-for="error in errors">{{error}}</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="name">Good</label>
                            <input v-model="new_update_good.good" type="text" id="good" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Quantity</label>
                            <input v-model="new_update_good.quantity" type="text" id="quantity" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">District</label>
                            <input v-model="new_update_good.district" type="text" id="district" class="form-control">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button @click="updateGoods" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Update Modal -->
    </div>
</template>

<script>
    export default {
        data(){
            return{
                goods:{
                    good: '',
                    quantity: '',
                    district: ''
                },
                errors: [],
                goodsArr: [],
                new_update_good: [],
                uri: 'http://127.0.0.1:8000/goods/',
                image: 'img/logo.png',
                loading: false
            }
        },

        methods:{
            resetData(){
                this.goods.good = '';
                this.goods.quantity = '';
                this.goods.district = '';
            },
            createModal(){
                $("#create-modal").modal("show");
            },
            createGoods(){
                axios.post(this.uri, {good:this.goods.good, quantity:this.goods.quantity, district:this.goods.district})
                .then(response=>{
                    this.resetData();
                    this.goodsArr.push(response.data.goods);
                    $("#create-modal").modal("hide");
                    toastr.success(response.data.message);
                }).catch(error=>{
                    this.errors = [];
                    if(error.response.data.errors.good){
                        this.errors.push(error.response.data.errors.good[0]);
                    }
                    if(error.response.data.errors.quantity){
                        this.errors.push(error.response.data.errors.quantity[0]);
                    }
                    if(error.response.data.errors.district){
                        this.errors.push(error.response.data.errors.district[0]);
                    }
                })
            },

            updateModal(index){
                this.errors = [];
                $("#update-modal").modal("show");
                this.new_update_good = this.goodsArr[index];
            },
            updateGoods(){
                axios.patch(this.uri + this.new_update_good.id, {
                    good:this.new_update_good.good, 
                    quantity:this.new_update_good.quantity,
                    district:this.new_update_good.district
                })
                .then(response=>{
                    $("#update-modal").modal("hide");
                    toastr.success(response.data.message);
                })
                .catch(error=>{
                    this.errors = [];
                    if(error.response.data.errors.good){
                    this.errors.push(error.response.data.errors.good[0]);
                    }
                    if(error.response.data.errors.quantity){
                        this.errors.push(error.response.data.errors.quantity[0]);
                    }
                    if(error.response.data.errors.district){
                        this.errors.push(error.response.data.errors.district[0]);
                    }
                })
            },
            deleteGoods(index){
                let confirmBox = confirm("Do you really want to remove this entry?");
                if(confirmBox == true){
                    axios.delete(this.uri + this.goodsArr[index].id)
                    .then(response=>{
                        this.$delete(this.goodsArr, index);
                        toastr.success(response.data.message);
                    }).catch(error=>{
                        console.log("Could not delete for some reason");
                    });
                }
            },
            loadGoods(){
                axios.get(this.uri).then(response => {
                    this.goodsArr = response.data.goods;
                    this.loading = true;
                });
            }
            
        },

        mounted() {
            this.loadGoods();
        }
    }
</script>
