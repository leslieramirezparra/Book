<template>
    <div class="modal fade" id="book_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ is_create ? 'Crear' : 'Editar' }} Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form @submit.prevent="saveBook">
                    <div class="modal-body">
                        <section class="row">
                            <!-- Title -->
                            <div class="col-12">
                                <label form="title">Titulo</label>
                                <Field name="title" v-slot="{ errorMessage, field }" v-model="book.name">
                                    <input type="text" id="title" v-model="book.name"
                                        :class="`form-control ${errorMessage ? 'is-invalid': '' }`"
                                        v-bind="field">
                                    <span class="invalid-feedback">{{ errorMessage }}</span>
                                    <!-- <span class="invalid-feedback" v-if="back_errors['title']">
                                        {{ back_errors['title'] }}
                                    </span> -->
                                </Field>
                            </div>
                        </section>
                    </div>

                    <!-- Buttons -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Almacenar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
import {Field, Form} from 'vee-validate'
import * as yup from 'yup';

export default {
    props:['authors_data', 'book_data'],
    components: {Field, Form},
    watch:{
        book_data(new_value){
            this.book= new_value
            if(!this.book.id) return
            this.is_create=false
            this.author = this.book.author_id
            this.category = this.book.category_id
        }
    },
    computed:{
        schema(){
            return yup.object({
                name: yup.string().required(),
                stock: yup.number().required().positive().integer(),
                description: yup.string(),
                author: yup.string().required(),
                category: yup.string().required()
            });
        },
    },

    data(){
        return{
            is_create: true,
            book:{},
            author:null,
            category:null,
            categories_data:[],
            load_category:false
        }
    },
    created(){
        this.index()
        console.log('hola')
    },
    methods: {
        index(){
            this.getCategories()
        },
        async saveBook(){
            try{
                console.log('hola')
                this.book.category_id = this.category
                this.book.author_id = this.author
                if (this.is_create) await axios.post('/books',this.book)
                else await axios.put(`/books/${this.book.id}`,this.book)
                await Swal.fire('succes','Felicidades')
                window.location.reload()
                // this.$parent.closeModal()
            } catch (error){
                console.error(error);

            }
        },
        async getCategories(){
            try{
                const { data: { categories } } = await axios.get('/categories/get-all')
                this.categories_data = categories
                this.load_category = true
            } catch (error){
                console.error(error);

            }
        },
        reset(){
            this.is_create = true,
            this.book = {},
            this.author = null,
            this.category = null,
            this.$parent.book = {}
            setTimeout(() => this.$refs.form.resetForm(),100);
        }
    }
}
</script>
