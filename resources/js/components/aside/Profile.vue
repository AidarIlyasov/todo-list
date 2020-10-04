<template>
    <div>
        <b-modal id="settings" title="Some user name" @ok="saveSettings()">
            <div class="form-group">
                <label for="user_name">User name</label>
                <input type="text" id="user_name" class="form-control form-control-sm" v-model="userName">
            </div>
            <div class="form-group">
                <label for="user_email">Email address</label>
                <input type="email" id="user_email" class="form-control form-control-sm" v-model="userEmail">
                <small class="form-text text-muted">
                    We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <img :src="previewImage" class="uploaded-image">
                <label for="uploadImage" class="btn btn-outline-primary btn-sm">
                    {{ previewImage ? 'uppload another image' : 'Uppload image'}}
                </label>
                <input type="file" class="d-none" @change="previewFiles" id="uploadImage" accept=".jpg, .jpeg, .png">
            </div>
        </b-modal>
    </div>

</template>
<script>
    import axios from "axios";
    import {bus} from "../../app";

    export default {
        data() {
            return {
                avatar: '',
                userName:     'David Andersan',
                userEmail:    'name@example.com',
                userImage:    '',
                previewImage: '',
            }
        },
        methods: {
            previewFiles(event) {
                let file = event.target.files[0];
                if (file.size > 70000) {
                    alert("Max image size 70KB");
                    return;
                }
                this.previewImage = URL.createObjectURL(file);
                this.userImage = file;
            },
            saveSettings() {

                const formData   = new FormData();
                formData.append('name', this.userName);
                formData.append('email', this.userEmail);
                formData.append('image', this.userImage);

                axios.post('api/users', formData, {
                    'headers': {'Content-Type': 'multipart/form-data'}
                }).then(res => {
                    this.$notify({
                        group: 'foo',
                        text: 'User settings saved'
                    });
                });
            }
        },
        created() {
            this.avatar = 'storage/images/users/' + 1;
            bus.$emit('user', this.userName);
        }
    }
</script>
<style>

</style>
