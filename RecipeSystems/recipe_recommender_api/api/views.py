from django.views.decorators.csrf import csrf_exempt
from rest_framework.response import Response
from rest_framework.decorators import api_view
from .XGBoostClassifier import XGBoostClassifier
from .DecisionTreeClassifierService import DecisionTreeClassifierService


@api_view(['POST'])
def predict_diet_type_using_xgb(request):
    if request.method == 'POST':
        print(request.data)
        data = request.data

        predicted_remark = XGBoostClassifier.predict( data['protein'], data['carbs'], data['fat'] )

        response = {'diet_type': predicted_remark}
        print(response)
        return Response(response)

    return Response()

@api_view(['POST'])
def predict_diet_type_using_dt(request):
    if request.method == 'POST':
        print('request: {0}'.format(str(request.data)))
        data = request.data

        predicted_remark = DecisionTreeClassifierService.predict(data['protein'], data['carbs'], data['fat'])

        response = {'diet_type': predicted_remark}
        print('Predicted diet type by decision tree: {0}'.format(str(response)))
        return Response(response)

    return Response()