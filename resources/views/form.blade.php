<div class ...="modal-body">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Форма обратного звонка</h4>
                </div>
                <div class="modal-body">
                    <form id="contactform" method="POST" class="validateform">
                        {{ csrf_field() }}

                        <div id="sendmessage">
                            Ваше сообщение отправлено!
                        </div>
                        <div id="senderror">
                            При отправке сообщения произошла ошибка. Продублируйте его, пожалуйста, на почту администратора <span>info@tdbakhmet.ru</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6 field">
                                <input type="text" class="form-control" name="name" placeholder="* Введите ваше имя" required />
                            </div>
                            <div class="col-md-6 field">
                                <input type="email" class="form-control" name="email" placeholder="* Введите ваш email" required />
                            </div>

                            <div class="col-lg-12 margintop10 field">
                                <textarea class="form-control" rows="12" name="message" class="input-block-level" placeholder="* Ваше сообщение..." required></textarea>
                                <p>
                                    <button class="btn btn-theme margintop10 pull-left" type="submit" >Отправить</button>
                                    <span class="pull-right margintop20">* Заполните, пожалуйста, все обязательные поля!</span>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#contactform').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/sendmail',
                data: $('#contactform').serialize(),
                success: function(result){

                    $('#myModal').modal('hide')

                }
            });
        });
    });
</script>