<!-- Formulario -->
<Form @submit="saveBook" :validation-schema="schema" ref="form">
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
                </Form>
<!-- Stock -->
 <div class="col-12 mt-2">
                                <Field name="stock" v-slot="{ errorMessage, field }" v-model="book.stock">
                                    <label form="stock">Cantidad</label>
                                    <input type="number" id="stock" v-model="book.stock"
                                        :class="`form-control ${errorMessage ? 'is-invalid': '' }`"
                                        v-bind="field">
                                    <span class="invalid-feedback">{{ errorMessage }}</span>
                                    <!-- <span class="invalid-feedback" v-if="back_errors['stock']">
                                        {{ back_errors['stock'] }}
                                    </span> -->
                                </Field>
                            </div>

                             <!-- Description -->
                            <div class="col-12 mt-2">
                                <Field name="description" v-slot="{ errorMessage, field }" v-model="book.description">
                                    <label form="description">Descripcion</label>
                                    <textarea v-model="book.description"
                                        :class="`form-control ${errorMessage ? 'is-invalid': '' }`"
                                        id="description" rows="3" v-bind="field"></textarea>
                                    <span class="invalid-feedback">{{ errorMessage }}</span>
                                    <!-- <span class="invalid-feedback" v-if="back_errors['stock']">
                                        {{ back_errors['stock'] }}
                                    </span> -->
                                </Field>
                            </div>

                            <!-- Author -->
                            <div class="col-12 mt-2">
                                <Field name="author" v-slot="{ errorMessage, field }" v-model="author">
                                    <label form="author">Autor</label>
                                    <v-select :options="authors_data" label="name" v-model="author"
                                        :reduce="author => author.id" v-bind="field" placeholder="Seleccione autor"
                                        :clearable="false" :class="`${errorMessage ? 'is-invalid': '' }`">
                                    </v-select>
                                    <span class="invalid-feedback">{{ errorMessage }}</span>
                                    <!-- <span class="invalid-feedback" v-if="back_errors['stock']">
                                        {{ back_errors['stock'] }}
                                    </span> -->
                                </Field>
                            </div>

                               <!-- Category -->
                            <div class="col-12 mt-2" v-if="load_category">
                                <Field name="category" v-slot="{ errorMessage, field, valid }" v-model="category">
                                    <label form="category">Categoria</label>
                                    <v-select id="category" :options="categories_data"  v-model="category"
                                        :reduce="category => category.id" v-bind="field" label="name" placeholder="Selecciona Cateogria"
                                        :clearable="false" :class="`${errorMessage ? 'is-invalid': '' }`">
                                    </v-select>
                                    <span class="invalid-feedback" v-if="!valid">{{ errorMessage }}</span>
                                    <!-- <span class="invalid-feedback" v-if="back_errors['stock']">
                                        {{ back_errors['stock'] }}
                                    </span> -->
                                </Field>
                            </div>
                        </section>

                        this.book.category_id = this.category
                this.book.author_id = this.author
                if (this.is_create) await axios.post('/books',this.book)
                else await axios.put(`/books/${this.book.id}`,this.book)
                await Swal.fire('success','Felicidades')
                window.location.reload()
