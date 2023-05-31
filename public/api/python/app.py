# How to install and setup Flask correctly
# https://stackoverflow.com/questions/31252791/flask-importerror-no-module-named-flask
#
# export FLASK_ENV=development
# "flask run" to launch the server
#
from flask import Flask, request, jsonify
import llm
import helpers

app = Flask(__name__)

""" if __name__ == '__main__':
    app.run(debug=True) """


@app.route("/")
def hello_world():
    return "This is my first API call!"


""" @app.route('/keywords', methods=["GET"])
def getKeywords():
    #return "ok"
    requestJson = request.args
    #requestJson = request.get_json(force=False)
    dictToReturn = {
        'result': {'data': keywords.getKeywords(requestJson['q'])},
        'success': True,
    }
    response = jsonify(dictToReturn)
    response.headers.add('Access-Control-Allow-Origin', '*')
    return response """


@app.route("/manuscript-summary", methods=["GET"])
def getManuscriptSummary():
    # return "ok"
    requestJson = request.args
    print(requestJson)
    # return "ok"
    # requestJson = request.get_json(force=False)
    prompt = """Summarize this text above in a 10 sentences abstract, and give 3 title suggestions and 5 keyword suggestions about 
    this research manuscript on the following JSON format:
    {"abstract":"?","titles" :["?","?","?"],"keywords" :["?","?","?","?","?"]}"""

    datar = """{"abstract":"This manuscript presents a system to evaluate actors’ responsibilities within a car crash by using a driving recorder video of the crash as the data source. The system consists of three different modules with a set of five distinct steps. The first module detects the crash time in a video and splits the crash interval into images for object detection. The second module detects crucial information used to evaluate responsibilities in a crash. The third module is a rule-based knowledge system of road rules that uses an inference engine to derive actors’ responsibilities within a crash. Experiments were done with 27 testing videos and 180 testing videos collected from YouTube. The main goal of this work is to improve the accuracy of the models and enable them to perform the highest accuracy possible.","titles" :["A System for Evaluating Actors' Responsibilities in a Car Crash","Heuristic Approach to Evaluating Actors' Responsibilities in a Car Crash","Evaluating Actors' Responsibilities in a Car Crash Using Heuristic Approaches"],"keywords" :["Car Crash","Driving Recorder Video","Crash Time Detection","Object Detection","Inference Engine"]}"""

    datar = """
     {"abstract":"This research focuses on developing a framework that combines crash detection, traffic sign detection, and a rule-based knowledge system for assessing the responsibility of actors in a crash. The research includes the development of a user interface that allows the user to upload a crash video and get the results of the evaluation in three steps. A specialized dataset of head-on crashes from a driving recorder was created to satisfy the system’s requirements. The originality of the paper is the proposal of a framework with a novel approach that combines crash detection, traffic sign detection, and a knowledge system to assess actors’ responsibilities from a crash video. Additionally, a simulated sandbox was created to generate crash videos for cases that are difficult to find video data for. The results of the research demonstrate the potential of the proposed framework to accurately assess the responsibility of actors in a crash.","titles":["Framework for Accurate Assessment of Actors’ Responsibilities in a Crash","Crash Responsibility Assessment Framework Using Artificial Intelligence","AI Framework for Assessing Actors' Responsibilities in a Crash"],"keywords":["Crash Detection","Traffic Sign Detection","Knowledge System","AI Framework","Responsibility Assessment"]}"""

    if "file" in requestJson:
        data = llm.llmFromFileContent(filePath=requestJson["file"], prompt=prompt)
    elif "text" in requestJson:
        data = llm.llmFromTextContent(textContent=requestJson["text"], prompt=prompt)

    dictToReturn = {
        # "result": {"data": datar},
        "result": {"data": data[0] if data[0] != "" else datar},
        # 'result': {'data': "test"},
        # 'result': {'data': llm.llmFromTextContent(textContent= requestJson['text'], prompt=prompt)},
        "success": True,
    }
    response = jsonify(dictToReturn)
    # print (dictToReturn)
    response.headers.add("Access-Control-Allow-Origin", "*")
    return response


@app.route("/manuscript-proofread", methods=["GET"])
def getManuscriptProofread():
    requestJson = request.args
    prompt = """Give the proofread version of this:"""

    datar = """
    \n\nRevised:\n\n1. Introduction\nCar crashes, also known as vehicle accidents, road traffic injuries, or road accidents, are serious issues faced and addressed daily by all countries across the globe. According to the World Health Organization (WHO) [1], traffic accidents are now the leading cause of death in children and young adults aged 5 to 29 years, indicating a need for a shift in the current child health agenda, which has largely overlooked road safety. Car crashes are the eighth leading cause of death for all age groups, surpassing HIV/AIDS, tuberculosis, and diarrheal diseases. Unfortunately, vehicle collisions will persist as long as vehicles exist.\n\nVehicle collisions can occur for a variety of reasons and factors [2,3,4], in different situations [5,6], and involving multiple parties. Therefore, it is important to investigate and identify the causes of the crash as well as the responsibilities of all involved to ensure that the incident was not criminal in nature and to determine who will be responsible for paying for damages. The police typically conduct their investigation manually, visiting the crash site, collecting data, drafting the crash report, assessing responsibility based on road rules, and producing a crash report that usually takes three (3) to fifteen (15) days to be completed. Meanwhile, insurance companies assign the claim to claims adjusters, who assess the cause of the accident and any claimed damages or injuries within approximately thirty (30) days and determine who was responsible for the crash before any damage payments can be initiated. Victims typically have to wait until the end of this process to receive compensation.\n\nOur goal is to automate the responsibility assessment process for both police officers and claim adjusters by creating a support system that can automatically and quickly report who was at fault when an incident occurs. This will facilitate the process, shorten the decision time, and reduce the amount of time victims have to wait to receive their compensation. This paper introduces our system, which is mainly based on image processing and can assist the police in evaluating actors\u2019 responsibilities automatically within a crossroad crash (one of the most common car accidents). The system uses the crash video recorded by the driving recorder of one of the vehicles involved in the crash as the input data source. It then assesses and outputs the evaluation of each actor\u2019s responsibility within the crash thanks to a rule-based knowledge system. This system was introduced to make the reasoning about responsibility assessment explainable and enable users to understand the results easily. To assess responsibilities, the system is equipped with three different modules and goes through three different steps: (1) detecting crash time within the crash video with the first module, (2) detecting all traffic signs within the crash video with the second module, and (3) using a rule-based knowledge system of road rules to deduce each party\u2019s probable responsibility with the third module. A head-on crash is not an object that a common vehicle detection model can recognize. Therefore, applying existing vehicle detection models such as [7,8,9] will fail or output wrong results with many false positives. To solve this issue, we have made our proposed model assume that if there is a head-on crash in an image with the angle of view of the driving recorder inside one of the vehicles involved in the crash, the crash can be recognized by taking into consideration only the collided vehicle, its shape, and its position within the video. Our contribution is the proposed framework that combines crash detection (using an original method that takes into account only the collided vehicle, its shape, and its position within the video), traffic signs detection, and a knowledge system to assess actors\u2019 responsibilities from a crash video. Furthermore, due to a lack of available datasets with the required data to train the system\u2019s detection models, we built our own dataset from scratch with more than 1500 images of head-on car crashes within crossroad accidents context taken by the driving recorder of one of the vehicles involved in the crash. This dataset, when made publicly available, can also be used by other researchers to train their models for applications in fields such as autonomous driving or driving assistance systems. Currently, the crash detection model, as well as the traffic light detection model, can be found in this repository (https://github.com/heltonyawovi/car-crashes-responsibility-assessor/tree/main/models (accessed on 8 September 2022)).\n\nDuring the evaluation, the performance of each module of the system was tested with different parameters and under different road conditions, including daytime and nighttime with good and bad visibility. The experiment's results show how the system performs in (1) detecting the crash time within a video using different vehicle types (cars, vans, and trucks), (2) detecting traffic signs within a crash video at varying view distances (far, close, and very close), and (3) assessing each party's responsibility.\n\nIn a previous work [10], we described the first prototype of our system trained with a manually created dataset of 531 head-on crash images and 3000 traffic light images. The system required user intervention during the crash-time detection phase to select the frame that best described the crash. We conducted experiments with 27 testing videos under different road conditions and vehicles involved. In this paper, we introduce the extended version of our system with additional training data (1530 manually created head-on crash images from videos and 3000 traffic lights images), and we conducted new experiments (with 180 testing videos collected and processed from YouTube) with and without user intervention during the crash time detection phase. The main goal of this current work is to improve the accuracy of our models and enable them to achieve the highest accuracy possible; we focus predominantly on data collection and new experiments. In the future work section, we describe improvements that we will make to the system\u2019s features to handle more crossroad crash cases, such as cases without traffic lights, with pedestrians involved, or with stop signs. \r\n\r\nRelated work has been conducted to propose car crash image and video databases, as well as road accident prediction and analysis models. The main areas of interest that these models investigate are (a) road accident forecasting using driving recorder videos [11-16, 17-19] or traffic surveillance cameras [20-22], (b) detection of problematic areas for circulation [6, 23-25], (c) real-time detection of traffic incidents [26, 27], and (d) speed calculation [28]. Existing work [29] has focused on support systems that predict expert responsibility attribution from explanatory variables. These variables are obtained from crash data routinely recorded by the police, according to a data-driven process with explicit rules in which the driver\u2019s responsibility is assessed by experts using all information contained in police reports.\n\nThe major challenge we faced while implementing our system was building a dataset with enough image data of head-on car crashes within the context of crossroad accidents taken by the driving recorder of one of the vehicles involved in the crash. Our dataset needed to include thousands of crash images taken from driving recorder videos before the model could perform well after the training phase. However, most of the existing sources of datasets related to a car crash on the web (such as the web platform Kaggle.com) do not have large datasets ready to download that fit our needs. Furthermore, publicly available datasets are generally from surveillance cameras [21, 30, 31, 32] or from driving recorders of vehicles that are not necessarily involved in the crash [17, 33, 34, 35, 36]. Therefore, we had to build a custom dataset that would fulfill all the system\u2019s requirements.\n\nTo date, there is no publicly available framework that can automatically assess drivers\u2019 responsibilities from a driving recorder video. Existing works using driving recorder videos have been focusing on crash detection [17, 37, 38, 39], analysis of driver distraction and inattention [40], or evaluation of risk factors [41]. The originality of this paper lies in the proposed framework with a novel approach that combines crash detection (using an original method that takes into account only the collided vehicle, its shape, and its position within the video), traffic sign detection, and a knowledge system to assess actors\u2019 responsibilities from a crash video. Furthermore, since a new specialized dataset (dedicated only to head-on crashes from ego vehicle\u2019s driving recorders) has been created to satisfy the system\u2019s requirements and made publicly available, it can be used by other researchers to train their models for applications in fields such as autonomous driving or driving assistance systems.\n\r\nUsing previously-occurred car crash data with artificial intelligence, Internet of Things [42,43], or machine learning [44] to predict future crashes or to detect factors leading to those fatalities is very important. In our work, we propose a heuristic approach to solve the problem of actors' responsibility determination when a crash occurs by using the driving recorder video of the crash as the data source. We have developed a system that helps evaluate each actor's responsibility within a car crash, particularly a crossroad crash with traffic lights. The system consists of three different modules, each with a set of five distinct steps.\r\n\r\nIn designing the system, there are many factors that must be taken into consideration. Some of these factors can be detected automatically, while some will require manual input. Here are some of the manual input factors, as well as some of the automatically detected factors and assumptions made during the implementation of the system:\r\n\r\nAutomatically detected factors: Crash time; Traffic light state; Daytime/Nighttime.\r\nManual input factors: Road width; Vehicles\u2019 speed; Vehicles\u2019 direction; Accident location; Drivers\u2019 information (name, age...); Exact time (hh:mm:ss).\r\nAssumptions: Both actors involved in the crash are cars; Vehicle A is the car from which the crash video was recorded; Both actors come from different ways.\r\n\r\nIt is important to note that the current version of the system only applies to crossroad crashes with traffic lights that involve two cars, and it takes only one crash video as input.\n\nDesign of the System\nTo implement a system that can evaluate actors\u2019 responsibilities within a crash using the crash video as the input data source, there is a need to implement distinct modules that can work together to achieve the final goal. The system is a set of three different modules, each having a specific job and working independently to achieve one sub-goal of the entire system. The first module is a module that can detect the crash time in a video and split the crash interval in that video into images for object detection. The second module is a module that can detect, in an image, crucial information used to evaluate responsibilities in a crash (such as traffic lights). The third and last module is a module based on a rule-based knowledge system of road rules that can use an inference engine to derive actors\u2019 responsibilities within a crash. Figure 1 shows the architecture of the system with the three modules.
    """
    if "file" in requestJson:
        data = llm.llmFromFileContent(
            filePath=requestJson["file"],
            prompt=prompt,
            splitInputAndAppendOutputs=True,
        )
    elif "text" in requestJson:
        data = llm.llmFromTextContent(
            textContent=requestJson["text"],
            prompt=prompt,
            splitInputAndAppendOutputs=True,
        )

    dictToReturn = {
        # "result": {"data": datar},
        "result": {
            "data": data[0] if data[0] != "" else datar,
            "originalText": "".join(data[1]),
        },
        # 'result': {'data': "test"},
        # 'result': {'data': llm.llmFromTextContent(textContent= requestJson['text'], prompt=prompt, splitInputAndAppendOutputs=True)},
        "success": True,
    }
    response = jsonify(dictToReturn)
    # print (dictToReturn)
    response.headers.add("Access-Control-Allow-Origin", "*")
    return response


@app.route("/manuscript-translation", methods=["GET"])
def getManuscriptTranslation():
    requestJson = request.args
    # lang = "ja"
    lang = helpers.httpGetParamsToList(requestJson["params"])["lang"]
    prompt = """Give the translation into %s of this:""" % (lang)
    # prompt = """Give the translation into %s of this:""" %(requestJson['lang'])

    datar = """
    1.紹介
車両事故、または車両事故、道路交通性傷害、または道路事故とも呼ばれる車両事故は、世界中の全ての国が日々取り組んでいる重大な問題です。
世界保健機関（WHO）[1]は最近、交通事故が5歳から29歳の子どもと若者の死因の第1位になったと報告しており、現在の子供の健康計画の変更が必要であることを示唆しています。これは、全年齢層で8番目に死因を超えるHIV / AIDS、結核、および下痢症です。車両が存在する限り、車両衝突は残念ながら続行するでしょう。

車両衝突の発生は多くの理由や要因[2,3,4]、異なる状況[5,6]や関係者の下で起こります。車の事故が起こるとき、それがどのような犯罪的な意図によって引き起こされたものでないか、そして関係するすべての当事者の責任を決定するために、調査と決定が重要となります。そのため警察は、事故現場に行き、フィールドでデータを収集し、事故を記録し、道路規則に基づいて責任を評価し、一般的に3～15日かかる事故報告書を作成するなどの手動処理を実行します。同時に、保険会社は保険調査官に割り当てます。保険調査官はプロであり、約30日間の間に保険請求を評価し、保険会社が支払う金額を決定します。保険調査官は、警察と同じように、事故の原因と被害や負傷が請求された場合の責任を調査し、被害賠償の支払いプロセスが開始される前に誰が事故を起こしたかを決定するために自分自身の証拠を集めます。被害者は、このプロセスの終わりを待つことで、彼らの賠償を受け取ることができます。

我たちの目標は、事故発生時に誰が間違えたかを自動的かつ迅速に報告できるサポートシステムを作成して、警察と保険調査員の責任評価プロセスを自動化することです。このようなことを行うことで、プロセスを容易にし、決定時間を短縮し、被害者が補償を受けるまでの時間を節約することを目指しています。本稿では、主に画像処理に基づいて我々のシステムを紹介します。このシステムは、交差点衝突（最も一般的な自動車事故の1つ）で警察が参加者の責任を自動的に評価するのを支援するため、事故に関与した1台の車輌の運転記録装置によって記録された事故映像を入力データソースとして使用します。ルールベースの知識システムの導入により、責任評価の説明ができるようになり、ユーザーが結果を容易に理解できるようになりました。責任を評価するために、システムは合計3つの異なるモジュールを搭載して、3つの異なるステップを経て行います：（1）最初のモジュールを使用して、事故映像内の事故時間を検出、（2）二番目のモジュールを使用して、事故映像内のすべての交通信号を検出、（3）第三のモジュールを使用して、道路規則のルールベースの知識システムを使用して、各当事者の可能な責任を推定します。正面衝突は、一般的な車両検出モデルが自身で認識するオブジェクトではありません。したがって、[7、8、9]などの既存の車両検出モデルを適用すると、多くの偽陽性で間違った結果が出力されるか失敗します。この問題を解決するために、我々は、もし事故に関与した1台の車輌の運転記録装置の視点から画像内に正面衝突があるならば、衝突車両の形状とその映像内の位置を考慮してのみ、その衝突を認識できるという仮定を我々の提案モデルに適用しました。我々の貢献は、事故検出（衝突車両、その形状、および映像内の位置を考慮した元の方法を使用して）、交通信号検出、および事故映像から参加者の責任を評価するための知識システムを組み合わせた提案フレームワークです。また、システムの検出モデルを訓練するために必要なデータを持つ利用可能なデータセットが不足しているため、頭部正面衝突の交差点事故のコンテキストで事故に関与した1台の車輌の運転記録装置で撮影された1500枚以上の画像から、我々自身のデータセットを構築しました。このデータセットは、他の研究者が自動運転や運転支援システムなどの用途でモデルを訓練するために、公開されるときにも使用できます。現在、事故検出モデルおよび交通信号検出モデルは、このレポジトリ（2022年9月8日にアクセスしましたhttps://github.com/heltonyawovi/car-crashes-responsibility-assessor/tree/main/models）にあります。

評価中、システムの各モジュールの性能は、異なるパラメータと、昼夜ともに良好または悪い視界の下でテストされました。実験の結果は、(1)異なる車種（車両、バン、トラック）を使用して動画内のクラッシュ時間を検出する、(2)遠方、近距離、非常に近距離からクラッシュ動画内の交通標識を検出する、および(3)各当事者の責任を評価する方法を示しています。

以前の研究[10]では、531のヘッドオンクラッシュ画像と3000の交通信号画像からなる手動で作成したデータセットを使用してトレーニングされた、最初のプロトタイプを説明しました。クラッシュ時の検出フェーズでは、クラッシュを最も詳しく記述するフレームをユーザーが選択する必要がありました。異なる道路状況と車両が関わる27のテストビデオでいくつかの実験を行いました。本稿では、新しいトレーニングデータ（1530の動画から作成された手動ヘッドオンクラッシュ画像と3000の交通信号画像）を追加した、システムの拡張版を紹介し、ユーザー介入有無でYouTubeから収集し加工した180のテストビデオで新しい実験を行いました。この現在の研究の主な目的は、モデルの精度を改善し、可能な限り最高の精度を達成することであるため、データ収集と新しい実験に焦点を当てています。将来の研究セクションでは、交差点クラッシュのより多くの場合を処理するために、システムの機能を改善するための今後の作業について説明します。例えば、交通信号がない場合、歩行者が関与している場合、または停止サインがある場合などです。

2. 関連する研究
自動車事故画像や動画データベースを提案するための研究が行われており、道路事故の予測や分析モデルも構築されている。これらのモデルが研究する主な分野は、(a) 運転記録動画[17,18,19]や交通監視カメラ[20,21,22]を用いた道路事故の予測[11,12,13,14,15,16]、(b) 車両の通行に影響を及ぼす問題箇所の検出[6,23,24,25]、(c) 交通事故の実時間検知[26,27]、(d) 速度計算[28]である。既存の研究[29]では、警察が定期的に記録する事故データからの説明変数を用いた専門家の責任決定を予測するサポートシステムに焦点を当てている。これらの変数は、専門家が警察報告書に記載された全ての情報を用いて評価する明示的なルールに基づくデータ駆動プロセスから利用可能である。

我々がシステムを実装する際に直面した主なチャレンジは、交差点での衝突に関する車両のうち1台のドライビングレコーダーから撮影された充分な画像データセットを構築することでした。モデルがトレーニングフェーズの後にうまく機能するには、私たちのデータセットには車両の事故に関連したウェブ（kaggle.comなどのウェブプラットフォーム）上のデータセットの多くの存在する既存のソースから千を超えるクラッシュ画像が含まれている必要があります。しかしながら、公開されているデータセットの多くは、衝突に関係していない車両のドライビングレコーダー[17,33,34,35,36]からのものや、監視カメラ[21,30,31,32]からのものです。したがって、私たちは、システムの要件をすべて満たすカスタムデータセットを構築する必要がありました。 However, to date, there is no publicly available framework that can automatically assess drivers’ responsibilities from a driving recorder video. Existing works using driving recorder videos have been focusing on crash detection [17,37,38,39], analysis of driver distraction and inattention [40], or risk factors evaluation [41]. The originality of this paper is the proposal of a framework with a novel approach that combines crash detection (using an original method that takes into account only the collided vehicle, its shape, and its position within the video), traffic signs detection, and a knowledge system to assess actors’ responsibilities from a crash video. Furthermore, since a new specialized dataset (dedicated only to head-on crashes from ego vehicle’s driving recorders) has been created to satisfy the system’s requirement when made publicly available, it can be used by other researchers to train their models for applications in fields such as autonomous driving or driving assistance systems.

3. 交差点事故内の責任評価
人工知能[42、43]や機械学習[44]などを用いて、以前に起きた車両事故のデータを使用して、今後の事故を予測したり、致死因を検出することは非常に重要です。しかしながら、これまでに公開されている自動車のドライブレコーダービデオからドライバーの責任を自動的に評価するためのフレームワークはありません。ドライブレコーダービデオを使用した既存の作品は、事故検出[17、37、38、39]、ドライバーの注意力や無関心の分析[40]、またはリスク要因評価[41]に焦点を当てています。この論文のオリジナリティは、事故検出（衝突した車両、形状、およびビデオ内の位置に注意した独自の方法を使用）、交通信号検出、および知識システムを組み合わせた新しいアプローチのフレームワークの提案です。さらに、システムの要件を満たすために、新しい専門データセット（主要車両のドライブレコーダーからの直面衝突専用）が作成され、公開された場合は、他の研究者が自律走行や運転支援システムなどの分野でモデルを訓練するために使用できるようになります。

車両の事故時の責任者の決定のための実証的なアプローチを提案する。交差点の事故、特に交通信号のある事故を考慮している。システムは3つの異なるモジュールから構成され、5つの独立したステップを持っている。

事故には、考慮すべき多くの要素がある。いくつかの要素は自動的に検出できるが、いくつかの要素は人間の入力を必要とする。以下は手動入力の要素と自動検出の要素、およびシステム実装中に行った仮定である：

    自動検出の要素：事故の時間、交通信号の状態、昼/夜

3.1.システムの設計
事故動画を入力データソースとして、俳優の責任を評価するシステムを実装するために、最終的な目標を達成するために一緒に動作する独立したモジュールを実装する必要があります。このシステムは、特定の仕事を持ち、全体のシステムのサブゴールを達成するために独立して動作する3つの異なるモジュールからなります。最初のモジュールは、動画内の事故時間を検出し、事故間隔を画像に分割するモジュールです。2番目のモジュールは、画像内の事故責任を評価するのに重要な情報（交通信号など）を検出するモジュールです。3番目および最後のモジュールは、ルールベースの知識システムの道路ルールを使用して推論エンジンを使用して事故中の俳優の責任を導出するモジュールです。図1は、3つのモジュールを備えたシステムのアーキテクチャを示しています。
    """
    if "file" in requestJson:
        data = llm.llmFromFileContent(
            filePath=requestJson["file"],
            prompt=prompt,
            splitInputAndAppendOutputs=True,
        )
    elif "text" in requestJson:
        data = llm.llmFromTextContent(
            textContent=requestJson["text"],
            prompt=prompt,
            splitInputAndAppendOutputs=True,
        )

    dictToReturn = {
        # 'result': {'data': prompt, 'lang':lang},
        # "result": {"data": datar, "lang": lang},
        "result": {
            "data": data[0] if data[0] != "" else datar,
            "lang": lang,
            "originalText": "".join(data[1]),
        },
        # 'result': {'data': "test"},
        # 'result': {'data': llm.llmFromTextContent(textContent= requestJson['text'], prompt=prompt, splitInputAndAppendOutputs=True), lang:lang},
        "success": True,
    }
    response = jsonify(dictToReturn)
    # print (dictToReturn)
    response.headers.add("Access-Control-Allow-Origin", "*")
    return response


@app.route("/manuscript-conversion", methods=["GET"])
def getManuscriptConversion():
    requestJson = request.args
    """ if "file" in requestJson:
        data = llm.llmFromFileContent(
            textContent=requestJson["file"],
            prompt=prompt,
            splitInputAndAppendOutputs=True,
        )
    elif "text" in requestJson:
        data = llm.llmFromTextContent(
            textContent=requestJson["text"],
            prompt=prompt,
            splitInputAndAppendOutputs=True,
        )

    from pylatexenc.latexencode import unicode_to_latex

    dictToReturn = {
        # 'result': {'data': prompt, 'lang':lang},
        "result": {"data": datar, "lang": lang},
        # 'result': {'data': "test"},
        # 'result': {'data': llm.llmFromTextContent(textContent= requestJson['text'], prompt=prompt, splitInputAndAppendOutputs=True), lang:lang},
        "success": True,
    }
    response = jsonify(dictToReturn) 
    # print (dictToReturn)
    response.headers.add("Access-Control-Allow-Origin", "*")
    return response
    """
