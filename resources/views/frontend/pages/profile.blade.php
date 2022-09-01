@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')


<section id="ab-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="ab-thumb wow animated fadeInRight" data-wow-delay="300ms"
                    data-wow-duration="1500ms"><img src="{{asset('public/frontend')}}/media/about/7.png" alt="about"></div>
            </div>
            <div class="col-md-6">
                <div class="ab-content wow animated fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <h2 class="section-title">人と街にやさしい住まいを </h2>

                    <h5>わたしたちは、みなさまが安全で快適に過ごせる、 環境にやさしい住まいづくりを目指しています。
                    </h5>
                    <p>
                        わたしたちは、お客様のご意見を参考に、お客様のご予算に合わせ、ライフプランを 考慮した付加価値の高い提案を行い、1つ上のリフォームを実現いたします。 そして、環境にやさしく安心・安全で快適に過ごせる住まいづくりを目指しています。 わたしたちのリフォームは、お客様にご満足いただけるような空間づくりを旨とし、 よりよいライフスタイルを築く機会になることを目標にしています。 そして、お客様と長くお付き合いできるようにきめ細かいメンテナンスを行い、コミ ュニケーションを取りながら、よりよい仕事をしていきたいという想いで、スタッフ 一同、懸命に対応させていただきます。どうぞよろしくお願いいたします。

                    </p>
                    <P class="text-right">ES Creative 工業株式会社 <br> 代表取締役社長　高橋　忍</P>
                 
                </div>
            </div>
          
        </div>
    </div>
</section>

    


<section>
    <div class="container">
        <h2>会社概要</h2>
        <div class="row">
            <div class="col">
                <div class="">
                    <table class="table">
                        <tr>
                            <th>会 社 名</th>
                            <td>:</td>
                            <td>ES Creative 工業株式会社</td>
                        </tr>

                        <tr>
                            <th>代 表</th>
                            <td>:</td>
                            <td>代表取締役社長　高橋　忍</td>
                        </tr>
                        <tr>
                            <th>所 在 地</th>
                            <td>:</td>
                            <td>本　　　社　〒343-0035 埼玉県越谷市大字大道 510 番地 1 階 <br>
                                TEL．048-940-3935 <br>
                                施工事務所　
                            </td>
                        </tr>

                        <tr>
                            <th>設 立</th>
                            <td>:</td>
                            <td>令和 1 年 12 月 26 日</td>
                        </tr>
                        <tr>
                            <th>資 本 金</th>
                            <td>:</td>
                            <td>500 万円</td>
                        </tr>

                        <tr>
                            <th>主要取引銀行</th>
                            <td>:</td>
                            <td>埼玉りそな銀行　北越谷支店 </td>
                        </tr>
                        <tr>
                            <th>法 人 番 号</th>
                            <td>:</td>
                            <td>80300001134563</td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>
</section>

<br><br>

<section>
    <div class="container">
        <h2>事業内容</h2>
        <div class="row">
            <div class="col-md-6">
                <ul>
                    <li>住宅リフォームの施工・管理</li>
                    <li>内装工事</li>
                    <li>外装工事</li>
                    <li>付帯設備工事</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul>
                    <li>リフォーム後のメンテナンス
                    </li>
                    <li>防犯工事</li>
                    <li>防火工事</li>
                    <li>耐震補強</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@include('frontend.layouts.banner')
@endsection