<template>
    <div>
        <div v-if="!loading">
            <img class="rounder mx-auto d-block" :src="image" alt="loader" width="25%">
        </div>

        <div v-else>
            <table class="table" v-if="donations">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Pledge</th>
                        <th scope="col">Message</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(donation, index) in donations">
                        <td>{{index + 1}}</td>
                        <td>{{donation.name}}</td>
                        <td>{{donation.pledge}}</td>
                        <td>{{donation.message}}</td>
                        <td><button @click="updateModal(index)" class="btn btn-edit">Edit</button></td>
                        <td><button @click="deleteDonation(index)" class="btn btn-delete">Delete</button></td>
                    </tr>
                </tbody>
            </table>
            <button @click="createModal" class="btn btn-create btn-block">Make A Donation</button>
        </div>

         <!-- Create Modal -->
        <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="create-modal-label">Donation Details</h5>
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
                            <label for="name">Name</label>
                            <input v-model="donation.name" type="text" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Pledge</label>
                            <input v-model="donation.pledge" type="text" id="pledge" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Message</label>
                            <input v-model="donation.message" type="text" id="message" class="form-control">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button @click="createDonation" type="button" class="btn btn-primary">Save changes</button>
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
                        <h5 class="modal-title" id="update-modal-label">Alter Donation</h5>
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
                            <label for="name">Name</label>
                            <input v-model="new_update_donation.name" type="text" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Pledge</label>
                            <input v-model="new_update_donation.pledge" type="text" id="pledge" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Message</label>
                            <input v-model="new_update_donation.message" type="text" id="message" class="form-control">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button @click="updateDonation" type="button" class="btn btn-primary">Save changes</button>
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
                donation:{
                    name: '',
                    pledge: '',
                    message: ''
                },
                donations: [],
                errors: [],
                new_update_donation: [],
                uri: 'http://127.0.0.1:8000/donations/', 
                image: "img/logo.png",
                loading: false
            }
        },

        methods:{
            loadDonation(){
                axios.get(this.uri).then(response=>{
                    this.donations = response.data.donations;
                    this.loading = true;
                })
            },
            
            createModal(){
                $("#create-modal").modal("show");
            },

            updateModal(index){
                this.errors = [];
                $("#update-modal").modal("show");
                this.new_update_donation = this.donations[index];
            },

            createDonation(){
                axios.post(this.uri, {
                    name:this.donation.name, 
                    pledge:this.donation.pledge,
                    message:this.donation.message
                })
                .then(response=>{
                    this.resetData();
                    this.donations.push(response.data.donations);
                    $("#create-modal").modal("hide");
                    toastr.success(response.data.msg);
                })
                .catch(error=>{
                    this.errors = [];
                    if(error.response.data.errors.name){
                        this.errors.push(error.response.data.errors.name[0]);
                    }
                    if(error.response.data.errors.pledge){
                        this.errors.push(error.response.data.errors.pledge[0]);
                    }
                    if(error.response.data.errors.message){
                        this.errors.push(error.response.data.errors.message[0]);
                    }
                })
            },

            updateDonation(){
                let confirmBox = confirm("Do you really want to change your donation?");

                if(confirmBox == true){
                    axios.patch(this.uri + this.new_update_donation.id, {
                        name:this.new_update_donation.name, 
                        pledge:this.new_update_donation.pledge,
                        message:this.new_update_donation.message
                    })
                    .then(response=>{
                        $("#update-modal").modal("hide");
                        toastr.success(response.data.msg);
                    })
    
                    .catch(error=>{
                        this.errors = [];
                        if(error.response.data.errors.name){
                        this.errors.push(error.response.data.errors.name[0]);
                        }
                        if(error.response.data.errors.pledge){
                            this.errors.push(error.response.data.errors.pledge[0]);
                        }
                        if(error.response.data.errors.message){
                            this.errors.push(error.response.data.errors.message[0]);
                        }
                    })
                }
            },

            resetData(){
                this.donation.name = '';
                this.donation.pledge = '';
                this.donation.message = '';
            },

            deleteDonation(index){
                let confirmBox = confirm("Do you really want to remove your donation?");
                if(confirmBox == true){
                    axios.delete(this.uri + this.donations[index].id)
                    .then(response=>{
                        this.$delete(this.donations, index);
                        toastr.success(response.data.msg);
                    }).catch(error=>{
                        console.log("Could not delete for some reason");
                    });
                }
            }
        },

        mounted() {
            this.loadDonation();
        }
    }
</script>
