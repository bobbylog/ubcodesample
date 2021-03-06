USE [CAMS_Enterprise]
GO
/****** Object:  StoredProcedure [dbo].[Adv_CreateAlerts]    Script Date: 02/06/2017 14:51:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
ALTER PROCEDURE [dbo].[Adv_CreateAlerts]
	-- Add the parameters for the stored procedure here
	@Pstid varchar(25),
	@DtAlert datetime ,
	@Tm varchar(25),
	@StuID varchar(25),
	@FacID varchar(25),
	@CoID varchar(25),
	@Coname varchar(150),
	@CAtt bit,
	@CLat bit ,
	@CAssign bit ,
	@CPIss bit ,
	@CInat bit,
	@COther varchar(400),
	@Nt varchar(max)

AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
    
    declare @nc int
    
    set @nc=0
    
   
	 select @nc=count(postid) from AdvPortalAlerts where postid=LTRIM(RTRIM(@Pstid))
    
    if(@nc=0)
    begin
	INSERT INTO 
	
	[AdvPortalAlerts]
           ([Postid]
           ,[DateAlert]
           ,[TTerm]
           ,[StudentID]
           ,[FacultyID]
           ,[CourseID]
           ,[Coursename]
           ,[CAttendance]
           ,[CLate]
           ,[CAssignment]
           ,[CPIssues]
           ,[CInattentive]
          ,[COther]
          ,[Notes]
           )
		 values (
		LTRIM(RTRIM(@Pstid)),
		@DtAlert ,
		@Tm,
		@StuID,
		@FacID,
		@CoID,
		@Coname,
		@CAtt,
		@CLat  ,
		@CAssign,
		@CPIss ,
		@CInat ,
		@COther,
		@Nt
		)
	
	
	
	
	
	-- Send Email Notifications
	declare @EmailS varchar(100)
	declare @glfile varchar(max)
	declare @topic varchar(300)
	declare @tbody varchar(max)
	Declare @CAttt varchar(150)
    Declare @CLatt  varchar(150)
	Declare @CAssignt varchar(150) 
	Declare @CPIsst varchar(150) 
	Declare @CInatt varchar(150) 
	Declare @COthert varchar(400) 
	
	-- set @EmailS=dbo.getStudentEmailAddressFromID(@StuID)
	
	if (@CAtt=0) set @CAttt='' else set @CAttt='. Missed more than 2 classes'+ '<br/>'-- CHAR(13)
	if (@CLat=0) set @CLatt='' else set @CLatt='. Online classes – inactive for more than 2 weeks online'+'<br/>'-- CHAR(13)
	if (@CAssign=0) set @CAssignt='' else set @CAssignt='. Arrives Late or Leaves early'+'<br/>'-- CHAR(13)
	if (@CPIss=0) set @CPIsst='' else set @CPIsst='. Missing Assignments'+'<br/>'-- CHAR(13)
	if (@CInat=0) set @CInatt='' else set @CInatt='. Student not making progress'+'<br/>'-- CHAR(13)
	if (@COther='') set @COthert='' else set @COthert= '. Other: '+@COther +'<br/>'-- CHAR(13)
	
	
	set @topic='Warning Notifications  as of '+LEFT(CONVERT(VARCHAR, GETDATE(), 120), 10)
	-- set @glfile=@filename1
	set @tbody= '<p><b>Date: '+LEFT(CONVERT(VARCHAR, GETDATE(), 120), 10)+'</b></p>' -- CHAR(13)+CHAR(13)
	set @tbody= @tbody+'<p><b>Dear ' + dbo.getStudentFullNameWOptions(@StuID,0)+',</b></p>' -- CHAR(13)+CHAR(13)+CHAR(10)
	set @tbody= @tbody + '<p> Your instructor in Course <b> ('+ @CoID + ') - '+ @Coname + '</b> has submitted an Academic Alert for you, so that you may take the necessary steps to be successful in this class. Professor <b>' + dbo.getFacultyFullName(@facid,2) + '</b> ''s alert has indicated: </p>' -- +CHAR(13)+CHAR(13)+CHAR(10)
	set @tbody= @tbody+'<p><b>AREA OF CONCERN NOTED IN ALERT</b></p>' -- +CHAR(13)+CHAR(13)+CHAR(10)
	set @tbody= @tbody+'<p>'+@CAttt+@CLatt+@CAssignt+@CPIsst+@CInatt+@COthert+'</p>' -- CHAR(13)+CHAR(13)+CHAR(10)
	set @tbody= @tbody+'<p><b>COMMENTS WRITTEN BY FACULTY MEMBER</b></p>' -- +CHAR(13)+CHAR(13)+CHAR(10)
	set @tbody= @tbody+'<p><i>'+@Nt+'</i></p>' -- +CHAR(13)+CHAR(13)+CHAR(10)
	set @tbody= @tbody+'<p>Please speak with your instructor to resolve these issues as soon as possible.  This alert is designed to help you get back on track toward successfully progressing at Trocaire. </p>' --+CHAR(13)+CHAR(13)+CHAR(10)
	set @tbody= @tbody+'<p>Additional resources available to you: <br/>• Your advisor <b> ' + dbo.getAdvisorDetailsByStudentID(@Tm,@StuID,6)+'</b></p>' --+CHAR(13)+CHAR(13)+CHAR(10)
	set @tbody= @tbody+'<p>• Questioning your career choice? Contact Maureen Huber, Advisement & Career Services, at 716-827-2444 or HuberM@Trocaire.edu</p>' --+CHAR(13)+CHAR(13)+CHAR(10)
	set @tbody= @tbody+'<p>• Experiencing personal struggles? Contact our Student Counselor, Lauren Ellis, Room 112; 716-827-2412 or EllisL@Trocaire.edu</p>' --+CHAR(13)+CHAR(13)+CHAR(10)	
    set @tbody= @tbody+'<p>• Need tutoring? Contact Claudia Lesinski, Tutoring Center, Room 333, 716-827-2553 or LesinskiC@Trocaire.edu</p>' -- +CHAR(13)+CHAR(13)+CHAR(10)	
    set @tbody= @tbody+'<p>Please take a moment now to contact any one of us to help you get back on track. </p>' -- +CHAR(13)+CHAR(13)+CHAR(10)
    set @tbody= @tbody+'<p><b>We wish you much success this semester!<br/>' --+CHAR(13)
    set @tbody= @tbody+'The Staff in Advisement & Career Services</b></p>' --+CHAR(13)+CHAR(13)+CHAR(10)
    

	
	
	--CHAR(13)+CHAR(13)+CHAR(10)+'Regards, '+CHAR(13)+CHAR(13)+CHAR(10)+'Senghor E '

	-- Send an email
	EXEC msdb.dbo.sp_send_dbmail 
	@profile_name='TROCMAIL',
	@recipients = 'etiennes@trocaire.edu', 
	--@file_attachments =@glfile,
	-- @query = 'SELECT * FROM CAMS_ENTERPRISE.dbo.tmpStudentStatHistory WHERE DAY(SDATE)=DAY(GETDATE()) AND MONTH(SDATE)=MONTH(GETDATE()) AND YEAR(SDATE)=YEAR(GETDATE())',
	@subject = @topic ,
	@body = @tbody ,
	@body_format = 'HTML' ;  
	
	end
	
	select @@ROWCOUNT as Affected	
	
	
	--select '1' as affected
	
END
