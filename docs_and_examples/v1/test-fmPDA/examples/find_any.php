<?php
// *********************************************************************************************************************************
//
// find_any.php
//
// This test uses the 'Find Any' query to randomly return one record. Since this isn't directly supported in the Data API,
// fmPDA will always return the first record in the table. That's as random as anything, right? :)
//
// *********************************************************************************************************************************
//
// Copyright (c) 2017 - 2024 Mark DeNyse
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.
//
// *********************************************************************************************************************************

require_once 'startup.inc.php';

$fm = new fmPDA(FM_DATABASE, FM_HOST, FM_USERNAME, FM_PASSWORD);

$findAnyCommand = $fm->newFindAnyCommand('Web_Project');

$findAnyCommand->setScript('Test', 'test-params');
$findAnyCommand->setPreCommandScript('Precommand', 'precommand-params');
$findAnyCommand->setPreSortScript('Presort', 'presort-params');

$result = $findAnyCommand->execute();

if (! fmGetIsError($result)) {

   $record = $result->getFirstRecord();
   if (! is_null($record)) {
      fmLogger('Project Name = '. $record->getField('Name'));

      //
      // Dump out the fields and their values
      //
      $fields = $result->getFields();
      if (count($fields) > 0) {
         fmLogger('');
         fmLogger('Fields:');
         foreach ($fields as $field) {
            fmLogger('&nbsp;&nbsp;&nbsp;'. $field);
         }

         fmLogger(" *** Demonstration of converting time stamp. 'time' conversion will fail. ***");
         $t = $record->getFieldAsTimeStamp('Date_Start', 0, 'date');
         fmLogger('&nbsp;&nbsp;&nbsp;'. 'Date_Start (as date value)' .' = '. (! fmGetIsError($t) ? $t : $t->getMessage()));
         $t = $record->getFieldAsTimeStamp('Date_Start', 0, 'time');
         fmLogger('&nbsp;&nbsp;&nbsp;'. 'Date_Start (as time value)' .' = '. (! fmGetIsError($t) ? $t : $t->getMessage()));
         $t = $record->getFieldAsTimeStamp('Date_Start', 0, 'timestamp');
         fmLogger('&nbsp;&nbsp;&nbsp;'. 'Date_Start (as timestamp value)' .' = '. (! fmGetIsError($t) ? $t : $t->getMessage()));
      }


      //
      // Now show all the related sets (portals) attached to this record, and dump the values of all fields.
      //
      $relatedSets = $result->getRelatedSets();
      if (count($relatedSets) > 0) {
         fmLogger('');
         fmLogger('Related Sets by Result:');
         foreach ($relatedSets as $relatedSetName) {
            fmLogger('&nbsp;&nbsp;&nbsp;'. $relatedSetName);
            $relatedSet = $record->getRelatedSet($relatedSetName);
            if (! fmGetIsError($relatedSet)) {
               foreach ($relatedSet as $relatedRecord) {
                  $fieldNames = $relatedRecord->getFields();
                  foreach ($fieldNames as $fieldName) {
                     fmLogger('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $fieldName .'='. $relatedRecord->getField($fieldName));
                  }
               }
               fmLogger('');
            }
         }
      }

      // fmPDA has very limited to support for metadata since the Data API has none. All we can do is return data about a field
      // that comes from an existing record. This may be the area of your code you have to change a lot if you've relied on metadata.
      //
      // Dump the fields on this layout.
      //
      $layout = $record->getLayout();
      fmLogger('');
      fmLogger('Fields by Layout:');
      fmLogger($layout->listFields());


      //
      // Dump the related sets on this layout.
      //
      fmLogger('Related Sets by Layout:');
      $relatedSets = $layout->listRelatedSets();
      foreach ($relatedSets as $relatedSet) {
         $set = $layout->getRelatedSet($relatedSet);
         fmLogger('&nbsp;&nbsp;&nbsp;'. $set->getName());
//       fmLogger($set->listFields());
         $fields = $set->getFields();
         foreach ($fields as $fieldname => $field) {
            fmLogger('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $fieldname);
         }
      }
   }
}
else {
   fmLogger('Error = '. $result->getCode() .' Message = '. $result->getMessage());
}

echo fmGetLog();

?>
