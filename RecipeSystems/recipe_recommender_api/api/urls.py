from django.urls import path
from . import views

urlpatterns = [
    path('v1/predict_diet_type', views.predict_diet_type_using_xgb),
    path('v2/predict_diet_type', views.predict_diet_type_using_dt)
]