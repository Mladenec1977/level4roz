<template>
    <div class="container">
        <div class="progress" style="height: 40px">
            <div class="progress-bar" role="progressbar" :style="{ width: fileProgress + '%'}">{{ fileCurrent }}%</div>
        </div>
        <hr>
        <input type="file" name="image" multiple="" @change="fileInputChange">
        <hr>
        <div class="row">
            <div class="col">
                <h5 class="text-center">Queued file ({{ filesOrder.length }})</h5>
                <ul class="list-group">
                    <li class="list-group-item" v-for="file in filesOrder">
                        {{ file.name }} : {{ file.type }}
                    </li>
                </ul>
            </div>
            <div class="col">
                <h5 class="text-center">Files uploaded ({{ filesFinish.length }})</h5>
                <ul class="list-group">
                    <li class="list-group-item" v-for="file in filesFinish">
                        {{ file.name }} : {{ file.type }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
       'peopleid'
    ],
    data() {
        return {
            filesOrder: [],
            filesFinish: [],
            fileProgress: 0,
            fileCurrent: '',
            idpeople: 0
        }
    },
    mounted() {
        this.update()
    },
    methods: {
        update: function () {
            this.idpeople = +(this.peopleid);
        },
        async fileInputChange() {
            let files = Array.from(event.target.files);
            this.filesOrder = files.slice();
            for (let item of files) {
                await this.uploadFile(item);
            }
        },
        async uploadFile(item) {
            let form = new FormData();
            form.append('image', item);
            await axios.post('/photo/' + this.idpeople, form, {
                    onUploadProgress: (itemUpload) => {
                        this.fileProgress = Math.round((itemUpload.loaded / itemUpload.total) * 100);
                        this.fileCurrent = item.name + ' ' + this.fileProgress;
                    }
                }
            )
                .then(response => {
                    this.fileProgress = 0;
                    this.fileCurrent = '';
                    this.filesFinish.push(item);
                    this.filesOrder.splice(item, 1);
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>
