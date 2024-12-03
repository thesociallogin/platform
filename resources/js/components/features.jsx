import appScreenshot from '@/../images/app.png'
import { Container } from '@/components/container.jsx'
import { Screenshot } from '@/components/screenshot.jsx'
import { Heading, Subheading } from '@/components/text.jsx'

export default function Features() {
  return (
    <div className='overflow-hidden'>
      <Container className='pb-24'>
        <Subheading>Dashboard</Subheading>
        <Heading as='h2' className='max-w-3xl'>
          A central command for all your apps.
        </Heading>
        <Screenshot width={1216} height={768} src={appScreenshot} className='mt-16 h-[36rem] sm:h-auto sm:w-[76rem]' />
      </Container>
    </div>
  )
}
