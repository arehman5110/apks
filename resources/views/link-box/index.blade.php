@extends('layouts.app', ['page_title' => 'Index'])


<x-data-table :url="'link-box-pelbagai-voltan'" :excelUrl="'generate-link-box-excel'">

    <table id="myTable" class="table table-bordered table-hover data-table">


        <thead style="background-color: #E4E3E3 !important">
            <tr>
                <th>ZONE</th>
                <th>BA</th>
                <th>TEAM</th>
                <th>VISIT DATE</th>
                <th>ACTION</th>

            </tr>
        </thead>
        <tbody>

           
        </tbody>
    </table>

</x-data-table>