<x-pdf-layout>

  <div class="name" style="font-size: 30px;color:#002060;font-weight:bold;text-transform:uppercase;margin: 10px 0;">
    {{ $applicant->first_name }} {{ $applicant->last_name }}
  </div>

  <div class="panoptik-candidate-match-analysis" style="padding-top: 20px; background-color:#e7e6e6;">
    <h1 style="color:#9999ff;font-size:20px;font-weight:bold;text-transform:uppercase;border-bottom:3px solid #9999ff;margin-bottom:10px;">PANOPTIK CANDIDATE MATCH ANALYSIS</h1>
    <p style="font-size:18px;">{{ $applicant->candidate_match_analysis }}</p>
  </div>

  <div class="career-objectives" style="padding-top: 20px;">
    <h1 style="color:#9999ff;font-size:20px;font-weight:bold;text-transform:uppercase;border-bottom:3px solid #9999ff;margin-bottom:10px;">CAREER OBJECTIVES</h1>
    <p style="font-size:18px;">{{ $applicant->career_objectives }}</p>
  </div>

  @if(isset($applicant->skills))
    @if(count($applicant->skills) > 0)
    <div class="skills" style="padding-top: 20px;">
      <h1 style="color:#9999ff;font-size:20px;font-weight:bold;text-transform:uppercase;border-bottom:3px solid #9999ff;margin-bottom:10px;">Skills</h1>
      <table class="w-full">
        <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
          <tr>
            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Skills</th>
            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 text-center">Years of Experience</th>
            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Proficiency Level</th>
            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 text-center">Last Year Used</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($applicant->skills as $skill)
          <tr>
            <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500">{{ $skill->skill }}</td>
            <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500 text-center">{{ $skill->years_of_experience }}</td>
            <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500">{{ $skill->proficiency_level }}</td>
            <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500 text-center">{{ $skill->last_year_used }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="4">No Skills Provided.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @endif
  @endif

  @if(isset($applicant->training_and_certifications))
    @if(count($applicant->training_and_certifications) > 0)
    <div class="training-and-certificates" style="padding-top: 20px;">
      <h1 style="color:#9999ff;font-size:20px;font-weight:bold;text-transform:uppercase;border-bottom:3px solid #9999ff;margin-bottom:10px;">TRAININGS AND CERTIFICATIONS</h1>
      <!-- <ol>
        @foreach ($applicant->training_and_certifications as $training_and_certification)
        <li class="pl-5"><h6> • <span class="ml-5">{{ $training_and_certification->training_and_certifications }}</span></h6></li>
        @endforeach
        
      </ol> -->
      <table class="w-full whitespace-nowrap">
        <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
          <tr>
            <th hidden class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($applicant->training_and_certifications as $training_and_certification)
          <tr>
            <td class="px-3.5 py-2.5 first:pl-5 last:pr-5">
              <div class="flex items-center gap-1">
                <div class="grow">
                  <h6 class="mb-1"> • {{ $training_and_certification->training_and_certifications }}</h6>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4">No Skills Provided.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @endif
  @endif

  <div class="education" style="padding-top: 20px;">
    <h1 style="color:#9999ff;font-size:20px;font-weight:bold;text-transform:uppercase;border-bottom:3px solid #9999ff;margin-bottom:10px;">Education</h1>
    <p style="font-size:18px;font-weight:bold;">{{ $applicant->educational_background->school }}</p>
    <p style="font-size:16px;font-style: italic;">{{ $applicant->educational_background->year }}</p>
    <p style="font-size:16px;font-weight:bold;">{{ $applicant->educational_background->course }}</p>
  </div>

  @if(isset($applicant->professional_experiences))
    @if(count($applicant->professional_experiences) > 0)
    <div class="professional-experience" style="padding-top: 20px;">
      <h1 style="color:#9999ff;font-size:20px;font-weight:bold;text-transform:uppercase;border-bottom:3px solid #9999ff;margin-bottom:10px;">Professional Experience</h1>
      @foreach ($applicant->professional_experiences as $professional_experience)
      <div class="data mt-5">
        <p style="font-size:18px;font-weight:bold;" class="uppercase">{{ $professional_experience->company }}</p>
        <p style="font-size:18px;font-weight:bold;" class="uppercase">{{ $professional_experience->position }}</p>
        <p style="font-size:18px;font-weight:bold;">{{ $professional_experience->month_year_range }}</p>

        @if(isset($professional_experience->duties_and_responsibilities))
        @if(count($professional_experience->duties_and_responsibilities) > 0)
        <p style="font-size:16px;font-style: italic;margin-top:10px;">Duties and responsibilities:</p>
        <ol>
          @foreach($professional_experience->duties_and_responsibilities as $duties_and_responsibility)
          <!-- <p>{{ $duties_and_responsibility->duty_and_responsibility }}</p> -->

          <li class="pl-5"> • <span class="ml-5">{{ $duties_and_responsibility->duty_and_responsibility }}</span></li>

          <!-- <h6 class="mb-1"> • {{ $duties_and_responsibility->duty_and_responsibility }}</h6> -->
          @endforeach
        </ol>
        @endif
        @endif
      </div>

      @endforeach
    </div>
    @endif
  @endif
  <div class="page-break"></div>
</x-pdf-layout>